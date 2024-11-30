FROM node:lts-alpine

WORKDIR /app

COPY package.json /app/package.json


RUN yarn install

COPY . /app

RUN yarn build

EXPOSE 80


CMD ["npm", "start"]
