FROM nginx:stable-alpine

#Add a user so we run in non-root mode
RUN addgroup -g 1001 -S appuser && adduser -u 1001 -S appuser -G appuser
RUN mkdir -p /var/www/app && chown -R appuser:appuser /var/www/app
RUN mkdir /logs && chown -R appuser:appuser /logs

# install bash
RUN apk update && apk add bash