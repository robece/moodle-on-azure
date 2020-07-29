
Chart install:

helm upgrade --install moodle bitnami/moodle --set replicaCount=1 --namespace=moodle --set externalDatabase.host=moodledb02.mysql.database.azure.com --set externalDatabase.port=3306 --set externalDatabase.database=moodle --set externalDatabase.user=moodleuser --set externalDatabase.password=Password.123 --set moodleSkipInstall=yes --set mariadb.enabled=false --set moodleUsername=admin --set moodlePassword=Password.123 --set moodleEmail=robece@protonmail.com --set nodeSelector\.kubernetes\.io/os=linux --set service.type=LoadBalancer --set persistence.enabled=true --set persistence.existingClaim=azure-managed-disk --set persistence.accessMode=ReadWriteOnce --set extraEnvVars[0].name=MOODLE_DATABASE_TYPE --set extraEnvVars[0].value=mysqli --set livenessProbe.enabled=false --set readinessProbe.enabled=false

Chart uninstall:

helm uninstall moodle --namespace moodle