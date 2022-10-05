Docker local testing environment
================================

This is simple test environment using a `db` container and `www`
container started by `docker-compose` in order to test the site
locally.

First run `setup.sh` script. It will:
- copy `local.neon` configuration
- create temporary directories needed by Nette
- copy a backup of database dump to be used for local DB
- update vendor libraries using composer

```
./setup.sh
```

Then start the cluster:

```
docker-compose up
```

The server is started on http://localhost to login use http://localhost/admin.

To destroy the cluster run:

```
docker-componse down
```
