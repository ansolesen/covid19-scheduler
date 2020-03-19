## About Covid Scheduler

This is a simple a scheduler application that on given time intervals will take data from the production 
database and insert it into our reporting database. A solution at database level would be better. Let me know if you 
have experience in that field.

## Assumptions

* Both databases have exactly the same scheme.
* Test correctness is based on SurveyFactory being held up to date with external schemes.

## Todo

*  InsertOrCreateReportingRows is inserting one row at a time. This is super inefficient and should be made into a
bulk SQL-query. Remember to run tests and possible write new ones.

* Make a better scheduler. At time of writing, it runs every 30 minutes and looks at entries modified within the
previous hour. Better ideas? If someone have tried Streaming Replication or other database level solutions, let me know.

