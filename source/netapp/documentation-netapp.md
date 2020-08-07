Link:
https://docs.microsoft.com/en-us/azure/aks/azure-netapp-files


NetApp Annotations:

az netappfiles account create \
    --resource-group MC_MINEDU_moodle-aks_westus2 \
    --location westus2 \
    --account-name netappacc01


az netappfiles pool create \
    --resource-group MC_MINEDU_moodle-aks_westus2 \
    --location westus2 \
    --account-name netappacc01 \
    --pool-name netappacc01pool01 \
    --size 4 \
    --service-level Premium

script1.sh

RESOURCE_GROUP=MC_MINEDU_moodle-aks_westus2
VNET_NAME=$(az network vnet list --resource-group $RESOURCE_GROUP --query [].name -o tsv)
VNET_ID=$(az network vnet show --resource-group $RESOURCE_GROUP --name $VNET_NAME --query "id" -o tsv)
SUBNET_NAME=NetAppSubnet
az network vnet subnet create \
    --resource-group $RESOURCE_GROUP \
    --vnet-name $VNET_NAME \
    --name $SUBNET_NAME \
    --delegations "Microsoft.NetApp/volumes" \
    --address-prefixes 10.0.0.0/28


script2.sh

RESOURCE_GROUP=MC_MINEDU_moodle-aks_westus2
LOCATION=westus2
ANF_ACCOUNT_NAME=netappacc01
POOL_NAME=netappacc01pool01
SERVICE_LEVEL=Premium
VNET_NAME=$(az network vnet list --resource-group $RESOURCE_GROUP --query [].name -o tsv)
VNET_ID=$(az network vnet show --resource-group $RESOURCE_GROUP --name $VNET_NAME --query "id" -o tsv)
SUBNET_NAME=NetAppSubnet
SUBNET_ID=$(az network vnet subnet show --resource-group $RESOURCE_GROUP --vnet-name $VNET_NAME --name $SUBNET_NAME --query "id" -o tsv)
VOLUME_SIZE_GiB=100 # 100 GiB
UNIQUE_FILE_PATH="myfilepath2" # Please note that creation token needs to be unique within all ANF Accounts

az netappfiles volume create \
    --resource-group $RESOURCE_GROUP \
    --location $LOCATION \
    --account-name $ANF_ACCOUNT_NAME \
    --pool-name $POOL_NAME \
    --name "myvol1" \
    --service-level $SERVICE_LEVEL \
    --vnet $VNET_ID \
    --subnet $SUBNET_ID \
    --usage-threshold $VOLUME_SIZE_GiB \
    --file-path $UNIQUE_FILE_PATH \
    --protocol-types "NFSv3"

script3.sh

RESOURCE_GROUP=MC_MINEDU_moodle-aks_westus2
ANF_ACCOUNT_NAME=netappacc01
POOL_NAME=netappacc01pool01
az netappfiles volume show --resource-group $RESOURCE_GROUP --account-name $ANF_ACCOUNT_NAME --pool-name $POOL_NAME --volume-name "myvol1"
