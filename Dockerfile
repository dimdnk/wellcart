FROM ubuntu:16.04
COPY setup-environment.sh /tmp
RUN chmod 0777 /tmp/setup-environment.sh
RUN /tmp/setup-environment.sh