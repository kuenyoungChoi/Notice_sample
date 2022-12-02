FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get -y install \
    git \
#    nodejs \
#    python3-pip python3-venv \
#    supervisor \
    net-tools \
    ssh \
    vim \
    && apt-get clean

WORKDIR /etc/ssh
RUN sed -i "s/#PermitRootLogin prohibit-password/PermitRootLogin yes/g" sshd_config
RUN sed -i "s/#PasswordAuthentication yes/PasswordAuthentication yes/g" sshd_config

ADD .bash_aliases /root/.bash_aliases

EXPOSE 21
EXPOSE 22

# d run -d --name 2204 seokjoon:ubuntu2204 sleep infinity

# OS requirements: https://docs.docker.com/engine/install/ubuntu/#os-requirements
#    Ubuntu Jammy 22.04 (LTS)
#    Ubuntu Impish 21.10
#    Ubuntu Focal 20.04 (LTS)
#    Ubuntu Bionic 18.04 (LTS)
# 마이너 버전일 경우 /etc/apt/sources.list.d/ 내부의 우분투 버전을 위의 버전 중 하나로 맞추어야 함
#  - 이유: docker 버전이 낮으면 빌드 전/후로 오류 발생