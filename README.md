# capito API mock server

## This mock server is for testing purposes only.

### Usable users

| E-Mail               | Account ID                             | Verified | Verification Token                                                 | Roles              |
|----------------------|----------------------------------------|----------|--------------------------------------------------------------------|--------------------|
| john.doe@example.com | `ff3be956-41b5-49a1-a295-7c654892ea06` | yes      | -                                                                  | admin              |
| jane.doe@example.com | `e8c4b512-e348-4713-9c75-9480dd6b48cc` | no       | `FyaL8Jn3pUjrygkVAv4Z67TKuMUKLptPr2kqjvzkVedsM2C75zmp5vW6CXxzZByC` | member, unverified |

For more information, see [Database definition](data/defaultDatabase.php).

### Hints

Token verification really verifies Jane Doe. If you want to re-run, [reset the database](#reset-database) first.

### CLI Scripts

#### Call Console Command
```shell
bin/app 
```


#### Reset database

```shell
bin/app capito:mock:reset
# or forced
bin/app captio:mock:reset -y
```
