FROM node:24.0-alpine AS build

WORKDIR /frontend

COPY . .

RUN npm install
RUN npx vite build --mode test

FROM httpd:2.4 AS server

COPY --from=build /frontend/dist /usr/local/apache2/htdocs/
