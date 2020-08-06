
Moodle Helm Chart install with custom image:

```

helm upgrade --install moodle bitnami/moodle --set image.repository=robecehub/moodle --set image.tag=1.0.36 --set replicaCount=1 --namespace=moodle --set externalDatabase.host=moodledb02.mysql.database.azure.com --set externalDatabase.port=3306 --set externalDatabase.database=moodle --set externalDatabase.user=moodleuser --set externalDatabase.password=Password.123 --set moodleSkipInstall=yes --set mariadb.enabled=false --set moodleUsername=admin --set moodlePassword=Password.123 --set moodleEmail=robece@protonmail.com --set nodeSelector\.kubernetes\.io/os=linux --set service.type=LoadBalancer --set extraEnvVars[0].name=MOODLE_DATABASE_TYPE --set extraEnvVars[0].value=mysqli --set livenessProbe.enabled=false --set readinessProbe.enabled=false --set persistence.enabled=true --set persistence.existingClaim=pvc-nfs



 --debug --dry-run
--set persistence.nfsEnabled=true --set persistence.nfsServer=10.0.0.4 --set persistence.nfsPath=/myfilepath2 

kubectl scale deployment moodle --replicas=4 --namespace moodle

```

Chart uninstall:

```
helm uninstall moodle --namespace moodle
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