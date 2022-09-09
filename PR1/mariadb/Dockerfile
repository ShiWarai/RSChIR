FROM mariadb as builder

ENV MYSQL_ROOT_PASSWORD=root_password

# That file does the DB initialization but also runs mysql daemon, by removing the last line it will only init
# that prevent stuck
RUN ["sed", "-i", "s/exec \"$@\"/echo \"not running $@\"/", "/usr/local/bin/docker-entrypoint.sh"]

COPY init.sql /docker-entrypoint-initdb.d/setup.sql

RUN ["/usr/local/bin/docker-entrypoint.sh", "mysqld", "--datadir", "/initialized-db", "--aria-log-dir-path", "/initialized-db"]

FROM mariadb

# Transfer data from initialized db to new stage
COPY --from=builder /initialized-db /var/lib/mysql