# Laravel N+1 Query Logger

A Laravel package that detects and logs N+1 queries in your application, helping you optimize database performance by identifying inefficient queries.

## Features

- **Automatic Detection**: The package listens to all database queries and automatically detects potential N+1 query problems.
- **File & Line Tracking**: Logs the file and line number where the N+1 query was triggered.
- **Logging**: Logs the detected N+1 queries including SQL, bindings, execution time, and the file/line number of the caller.
- **Environment-specific**: Only logs queries in non-production environments to avoid unnecessary logging in production.
- **Customizable Configuration**: You can enable/disable N+1 query logging and configure log levels through a config file.
- **Console Command**: View logged N+1 queries through an Artisan command.

## Installation

### Step 1: Install the package

Install the package via Composer:

```bash
composer require your-namespace/nplusone-logger
