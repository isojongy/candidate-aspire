## Environment
- The Code Challenge is pure API building, with no frontend skill required
- Environment setup: PHP (version from 7.4-8), MySQL
- README.md should contain all the information that the reviewers need to run and use the app
### *Laravel topics:
- API authentication: JWT or Passport
- Database: Model, Eloquent, Migration
- Laravel Http: Controller, Route, Resource
- Unit and feature tests

## Requirement
- Build a simple API that allows to handle user loans.
- Necessary entities will have to be (but not limited to): users, loans, and repayments.
- The API should allow simple use cases, which include (but are not limited to): creating a new
user, creating a new loan for a user, with different attributes (e.g. duration, repayment
frequency, interest rate, arrangement fee, etc.), and allowing a user to make repayments for
the loan.
- The app logic should figure out and not allow obvious errors. For example a user cannot
make a repayment for a loan that’s already been repaid.

## First Clone
1. run `composer install`
2. run `php artisan migrate --seed`
3. copy file .env from .env.example
4. run `php artisan jwt:secret`

## Start
2. run `php artisan serve`

## Testing
- create sample user
`DB::table('users')->insert(['name'=>'Dev 1','email'=>'dev1@gmail.com','password'=>Hash::make('123456')])`
