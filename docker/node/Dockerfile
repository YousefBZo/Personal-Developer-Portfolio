FROM node:20-alpine

WORKDIR /app

# Copy entrypoint script
COPY docker/node/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 5173

ENTRYPOINT ["/entrypoint.sh"]
