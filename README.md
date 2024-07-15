# capito API mock server

## This mock server is for testing purposes only.

### Usable users

| E-Mail               | Account ID                         | Verified | Verification Token                                                 | Bearer Token                         | Team     | Team ID                               | Team Roles         |
|----------------------|------------------------------------|----------|--------------------------------------------------------------------|--------------------------------------|----------|---------------------------------------|--------------------|
| john.doe@example.com | `auth0\|clylhwu7p0001ve50eury78rd` | yes      | -                                                                  | f0bc01d4-90fa-43b8-b22c-1b4cba62075c | The Does | `capitoAI\|clyli08340003ve50336lhapn` | admin, member      |
| jane.doe@example.com | `auth0\|clylhy1m70002ve50r17rptyd` | no       | `FyaL8Jn3pUjrygkVAv4Z67TKuMUKLptPr2kqjvzkVedsM2C75zmp5vW6CXxzZByC` | 6e2a203d-e830-4775-a1d8-c828511712fa | The Does | `capitoAI\|clyli08340003ve50336lhapn` | member, unverified |

For more information, see [Database definition](data/defaultDatabase.php).

The "Bearer token" is used for faking the Bearer Auth header inside the mock server.
You have to provide the token as Authentication header with type Bearer.

### Hints

Token verification really verifies Jane Doe. If you want to
re-run, [reset the database](#reset-database) first.

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
