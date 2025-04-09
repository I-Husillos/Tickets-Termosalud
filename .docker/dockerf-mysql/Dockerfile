FROM mysql:latest


RUN getent group mysql || groupadd -g 999 mysql
RUN getent passwd mysql || useradd -r -u 999 -g mysql mysql

RUN chown -R mysql:mysql /var/lib/mysql

