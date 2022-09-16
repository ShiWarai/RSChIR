FROM mariadb:latest
ENV MARIADB_ROOT_PASSWORD=root_password

WORKDIR /var/sql/
COPY init.sql .
ADD init.sql /docker-entrypoint-initdb.d