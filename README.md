# TER To-Do API

A Laravel 12 based To-Do API with filtering, summary, and Excel export features.

## Features

- **CRUD for To-Do items** with fields:
  - `title` (string, required)
  - `assignee` (string, optional)
  - `due_date` (date, required)
  - `time_tracked` (decimal, default 0)
  - `status` (enum: pending, open, in_progress, completed; default: pending)
  - `priority` (enum: low, medium, high)
- **Filtering** by all fields via query parameters:
  - `title`: partial match
  - `assignee`: multiple values, comma-separated (e.g., `John,Doe`)
  - `due_date`: range (`start=YYYY-MM-DD&end=YYYY-MM-DD`)
  - `time_tracked`: range (`min=X&max=Y`)
  - `status` and `priority`: multiple values, comma-separated
- **Excel export** with all columns and a summary row (total todos, total time tracked)
- **Summary endpoints** for status, priority, and assignee

## API Endpoints

### Create To-Do

`POST /api/todo`

**Request JSON:**
```json
{
  "title": "Make a cake",
  "assignee": "John",
  "due_date": "2025-06-20",
  "time_tracked": 5,
  "status": "open",
  "priority": "high"
}
```

`time_tracked` must be an integer value (no decimal points allowed). If no `status` is provided, it will be automatically set to `pending`.

### Export To-Dos with filters to Excel

`GET /api/todo/export?title=make&assignee=John,Doe&status=pending,open&priority=high&start=2025-06-01&end=2025-06-30&min=1&max=10`

### Get Summary

- **Status:** `GET /api/todo/chart?type=status`
- **Priority:** `GET /api/todo/chart?type=priority`
- **Assignee:** `GET /api/todo/chart?type=assignee`

**Example Response for Assignee:**
```json
{
  "assignee_summary": {
    "John": {
      "total_todos": 5,
      "total_pending_todos": 2,
      "total_timetracked_completed_todos": 5
    },
    "Doe": {
      "total_todos": 3,
      "total_pending_todos": 1,
      "total_timetracked_completed_todos": 2
    }
  }
}
```

## Setup

1. **Clone the repository**
2. **Install dependencies**
   ```
   composer install
   ```
3. **Configure `.env`**  
   Set your database and other environment variables.
4. **Run migrations**
   ```
   php artisan migrate
   ```
5. **Serve the application**
   ```
   php artisan serve
   ```

## Testing

- All API endpoints expect and return JSON.
- Export to Excel API return XML generated as can be saved as xlsx file.

## Notes

- Place all API routes in `routes/api.php`.

---

**Developed by Syarifme**