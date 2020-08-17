# Moodle on Azure

This repository pretend to act as an architectural guide to implement Moodle on Azure.

There are many ways to implement a cluster of Moodle, but we are going to cover two scenarios: 

- Virtual Machine scale sets
- Azure Kubernetes Service

In both scenarios we are going to use a custom Moodle image based on Bitnami Moodle hardened resource: https://github.com/bitnami/bitnami-docker-moodle.

Versions used in this repository:

- MariaDB: 10.5.4
- MySQL: 5.7
- Moodle: 3.9.1 (3.9.1-debian-10-r17)

# Using Virtual Machine scale sets

<div style="text-align:center">
    <img src="/resources/vmss-architecture.png" width="800" />
</div>

## Preparing Container Image

- It's possible to use the Dockerfile: https://github.com/robece/moodle-on-azure/blob/master/source/moodle/3.9.1-debian-10-r17/Dockerfile
  - This file is configured to automatically install PHP-Redis, add custom files to the installation and grant permissions to use NFS mounted devices.
  
- There is a patch feature in the libmoodle.sh file to paste all the Moodle custom files: https://github.com/robece/moodle-on-azure/blob/master/source/moodle/3.9.1-debian-10-r17/rootfs/opt/bitnami/scripts/libmoodle.sh#L181
  - This will help us to modify the resources any time the application is installed by the first time.

- After configure the container settings and deployed successfully, a new image will need to be push in the container registry (Dockerhub or Azure Container Registry) that will be used by the Virtual Machine to download the image.

Note: If you don't know the right settings for the container try to run locally withe the Bitnami parameters.

## Preparing Virtual Machine image

- Create an Azure Virtual Network resource.
  - This virtual network will be use to connect all the resources like: VM, VMSS and Netpp.

- Create an Azure Virtual Machine resource based on Ubuntu Server 18.04 LTS.
  - This virtual machine will be used as the workspace where we are going to configure all the resources needed before create the final image used in the Virtual Machine scale set.
  
- Create an Azure NetApp Files resource.
  - This storage resource will be use to share the Moodle application files between machines.
  
- Create the Azure NetApp Files resource capacity pool and volume using the same Azure Virtual Network created before.
  - Azure NetApp Files volume will be used as a mounted device in the Azure Virtual Machine.

- Install NFS dependencies in the Ubuntu Azure Virtual Machine.
  - This dependencies can be found in the mounting instructions in the NetApp Files volume resource.
 
- Mount NFS device by modifying the /etc/fstab file in the Ubuntu Azure Virtual Machine.
  - These parameters required to can be found in the mounting instructions in the NetApp Files volume resource.

- Install Docker and Docker Compose.
  - Docker Compose will be use to run the Moodle container

- Create the docker-compose.yml file.
  - The docker-compose file must start like a service everytime a VM is started.
  - There is a sample reference here: https://github.com/robece/moodle-on-azure/blob/master/source/docker-compose/moodle/docker-compose.yml.
  
- Configure docker-compose service to start automatically.
  - There is a sample reference here:
  
- Once everything is working as expected, go to Azure Portal and shutdown the Virtual Machine, then create an image of the Virtual Machine.
  - This image will be use to create a new Virtual Machine scale set resource.
  
Steps:

1. Create database and user in database (mysql or mariadb) then assign permissions.
https://docs.moodle.org/39/en/Installation_quick_guide

```
CREATE DATABASE moodle DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL ON moodle.* TO 'moodleuser'@'%' IDENTIFIED BY 'Password.123';
flush privileges;
```

2. Configure docker-compose file or AKS helm chart command.

3. Run docker-compose file or AKS helm chart command.
