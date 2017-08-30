# mybotman

Slack Chatbot Microservice Example using Docker and Botman.io

## Building the container

`docker build -t mybotman ./mybotman`

## Starting the microservice

`docker run -d -p 80:80 -e ENV_SLACK_TOKEN=[YOUR SLACK TOKEN]`
