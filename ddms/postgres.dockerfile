# Use the official Postgres 16 Alpine image as a base
FROM postgres:16-alpine

# Install necessary packages
RUN apk add --no-cache \
    git \
    make \
    gcc \
    clang \
    libc-dev \
    musl-dev \
    llvm \
    llvm-dev \
    llvm-static \
    postgresql-dev \
    postgresql-contrib

# Clone and install pgvector
RUN git clone --branch v0.8.0 https://github.com/pgvector/pgvector.git /usr/local/src/pgvector \
    && cd /usr/local/src/pgvector \
    && make && make install \
    && rm -rf /usr/local/src/pgvector

# Set the default Postgres entrypoint
CMD ["postgres"]
