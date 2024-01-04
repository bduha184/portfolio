FROM node:18.12.1-alpine

ENV TZ Asia/Tokyo

WORKDIR /frontend


RUN rm -rf .git/
RUN rm -rf node_modules

RUN apk update && \
    apk upgrade && \
    apk add bash && \
    npm install -g n && \
    yarn install

# RUN npx nuxi upgrade --force

EXPOSE 3000

COPY . /frontend

# CMD ["yarn", "dev"]
