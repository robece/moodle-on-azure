
Moodle Helm Chart install with custom image:

```

helm upgrade --install moodle-01 bitnami/moodle --set image.repository=robecehub/moodle --set image.tag=1.0.21 --set replicaCount=1 --namespace=moodle --set externalDatabase.host=moodledb02.mysql.database.azure.com --set externalDatabase.port=3306 --set externalDatabase.database=moodle --set externalDatabase.user=moodleuser --set externalDatabase.password=Password.123 --set moodleSkipInstall=yes --set mariadb.enabled=false --set moodleUsername=admin --set moodlePassword=Password.123 --set moodleEmail=robece@protonmail.com --set nodeSelector\.kubernetes\.io/os=linux --set service.type=LoadBalancer --set extraEnvVars[0].name=MOODLE_DATABASE_TYPE --set extraEnvVars[0].value=mysqli --set livenessProbe.enabled=true --set readinessProbe.enabled=true --set persistence.enabled=true --set persistence.existingClaim=azure-managed-disk-01 --set persistence.accessMode=ReadWriteOnce

helm upgrade --install moodle-02 bitnami/moodle --set image.repository=robecehub/moodle --set image.tag=1.0.21 --set replicaCount=1 --namespace=moodle --set externalDatabase.host=moodledb02.mysql.database.azure.com --set externalDatabase.port=3306 --set externalDatabase.database=moodle --set externalDatabase.user=moodleuser --set externalDatabase.password=Password.123 --set moodleSkipInstall=yes --set mariadb.enabled=false --set moodleUsername=admin --set moodlePassword=Password.123 --set moodleEmail=robece@protonmail.com --set nodeSelector\.kubernetes\.io/os=linux --set service.type=LoadBalancer --set extraEnvVars[0].name=MOODLE_DATABASE_TYPE --set extraEnvVars[0].value=mysqli --set livenessProbe.enabled=true --set readinessProbe.enabled=true --set persistence.enabled=true --set persistence.existingClaim=azure-managed-disk-02 --set persistence.accessMode=ReadWriteOnce

helm upgrade --install moodle-03 bitnami/moodle --set image.repository=robecehub/moodle --set image.tag=1.0.21 --set replicaCount=1 --namespace=moodle --set externalDatabase.host=moodledb02.mysql.database.azure.com --set externalDatabase.port=3306 --set externalDatabase.database=moodle --set externalDatabase.user=moodleuser --set externalDatabase.password=Password.123 --set moodleSkipInstall=yes --set mariadb.enabled=false --set moodleUsername=admin --set moodlePassword=Password.123 --set moodleEmail=robece@protonmail.com --set nodeSelector\.kubernetes\.io/os=linux --set service.type=LoadBalancer --set extraEnvVars[0].name=MOODLE_DATABASE_TYPE --set extraEnvVars[0].value=mysqli --set livenessProbe.enabled=true --set readinessProbe.enabled=true --set persistence.enabled=true --set persistence.existingClaim=azure-managed-disk-03 --set persistence.accessMode=ReadWriteOnce

```

Chart uninstall:

```
helm uninstall moodle-01 --namespace moodle
helm uninstall moodle-02 --namespace moodle
helm uninstall moodle-03 --namespace moodle
```

Redis:

```
helm upgrade --install redis bitnami/redis --namespace=redis --set cluster.enabled=true --set cluster.slaveCount=2 --set usePassword=false --set persistence.existingClaim=azure-managed-disk --set master.persistence.enabled=true --set slave.persistence.enabled=true --set master.service.type=LoadBalancer

Pending to validate:
--set sentinel.enabled=true
--set master.persistence.accessModes[0]=ReadWriteMany --set slave.persistence.accessModes[0]=ReadWriteMany
```

Chart uninstall:

```
helm uninstall redis --namespace redis
```