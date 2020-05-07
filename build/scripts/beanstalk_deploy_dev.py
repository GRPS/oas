"""
Bitbucket pipeline build for deploying UAT applications
to ElasticBeanstalk from a CloudFormation stack via Lambda
"""
from __future__ import print_function
import os
import sys
import time
from time import strftime
import boto3
from botocore.exceptions import ClientError

VERSION_LABEL = strftime("%Y%m%d%H%M%S")
BUCKET = os.getenv('DEV_S3_BUCKET')
BUCKET_KEY = os.getenv('DEV_APPLICATION_NAME') + '/' + VERSION_LABEL + \
    '-bitbucket_dev_builds.zip'
JSON = '{"RequestType":"start","Data":{"S3Key": "' + BUCKET_KEY + '"}}'
KEY_ID=os.getenv('DEV_AWS_ACCESS_KEY_ID')
KEY_SECRET=os.getenv('DEV_AWS_SECRET_ACCESS_KEY')
REGION=os.getenv('DEV_AWS_DEFAULT_REGION')

def upload_to_s3(artifact):
    """
    Uploads an application to S3
    """
    try:
        client = boto3.client('s3', aws_access_key_id=KEY_ID, aws_secret_access_key=KEY_SECRET,region_name=REGION)
    except ClientError as err:
        print("Failed to create boto3 client.\n" + str(err))
        return False

    try:
        client.put_object(
            Body=open(artifact, 'rb'),
            Bucket=BUCKET,
            Key=BUCKET_KEY
        )
    except ClientError as err:
        print("Failed to upload artifact to S3.\n" + str(err))
        return False
    except IOError as err:
        print("Failed to access artifact.zip in this directory.\n" + str(err))
        return False

    return True

def send_details_to_lambda():
    """
    sends the stack name to Lambda which will add it to dynamodb
    """
    try:
        client = boto3.client('lambda', aws_access_key_id=KEY_ID, aws_secret_access_key=KEY_SECRET,region_name=REGION)
    except ClientError as err:
        print("Failed to create boto3 client.\n" + str(err))
        return False

    try:
        response = client.invoke(
            FunctionName='edgecumbe-dev-deployment',
            Payload=JSON.encode('utf-8')
        )
    except ClientError as err:
        print('Failed to send details to lambda.\n' + str(err))
        return False

    try:
        if response['ResponseMetadata']['HTTPStatusCode'] is 200:
            return True
        else:
            print(response)
            return False
    except (KeyError, TypeError) as err:
        print(str(err))
        return False

    return True

def main():
    """
    uploads new package to s3,
    then creates cloudformation stack with package's s3 location,
    and finally adds stack name to lambda/dynamodb
    """
    if not upload_to_s3('/tmp/artifact.zip'):
        sys.exit(1)
    if not send_details_to_lambda():
        sys.exit(1)

if __name__ == "__main__":
    main()