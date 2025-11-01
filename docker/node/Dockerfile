FROM node:18-alpine

# Set working directory
WORKDIR /app

# Install dependencies for file watching
RUN apk add --no-cache \
    git

# Install global npm packages
RUN npm install -g npm@latest

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm install

# Default command (will be overridden by docker-compose)
CMD ["npm", "run", "dev"]
