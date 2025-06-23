<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Events</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/allevents.css') }}">
  <style>
    :root {
      --primary-color: #4e73df;
      --primary-dark: #3b5aa9;
      --secondary-color: #10b981;
      --background-color: #f7f9fc;
      --text-color: #1f2937;
      --border-radius: 12px;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      --spacing-sm: 0.75rem;
      --spacing-md: 1.5rem;
      --spacing-lg: 2rem;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      /* Updated background with cool blue gradient */
      background: linear-gradient(135deg, #e0f7fa, #80deea);
      color: var(--text-color);
      line-height: 1.5;
    }

    .container {
      width: min(95%, 1280px);
      margin-inline: auto;
      padding: var(--spacing-md);
    }

    .page-header {
      text-align: center;
      margin-bottom: var(--spacing-lg);
      padding: var(--spacing-md) 0;
    }

    .page-title {
      font-size: clamp(1.75rem, 4vw, 2.5rem);
      font-weight: 800;
      color: var(--text-color);
      margin-bottom: var(--spacing-sm);
      position: relative;
      display: inline-block;
    }

    .page-title::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: var(--primary-color);
      border-radius: 2px;
    }

    /* Original Filter Styles */
    .filters {
      margin-bottom: var(--spacing-lg);
    }

    .filter-groups {
    display: flex;
    flex-direction: column;
    align-items: center; /* centers each filter group */
    gap: var(--spacing-md);
}

.filter-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* centers the buttons within each group */
    gap: var(--spacing-sm);
}


  

    .filter-group {
      display: flex;
      flex-wrap: wrap;
      gap: var(--spacing-sm);
    }

    .filter-button {
      padding: 0.75rem 1.25rem;
      background-color: white;
      color: var(--text-color);
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 0.95rem;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      /* Added blue outline for buttons */
      border: 2px solid var(--primary-color);
    }

    .filter-button:hover {
      background-color: #f3f4f6;
      transform: translateY(-2px);
    }

    .active-filter {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      font-weight: 600;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
      transform: translateY(-3px);
      /* Ensure active filters also have the outline */
      border: 2px solid var(--primary-color);
    }

    .active-filter:hover {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
    }

    .active-filter::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 8px;
      height: 8px;
      background: var(--primary-color);
      border-radius: 50%;
    }

    /* Improved Event Cards */
    .events-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr));
      gap: var(--spacing-md);
    }

    .event-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: var(--spacing-md);
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
      /* Added blue outline for event tiles */
      border: 2px solid var(--primary-color);
    }

    .event-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    /* Adjusting the left stripe so it sits nicely with the new outline */
    .event-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -2px;
      width: 4px;
      height: 100%;
      background: var(--primary-color);
    }

    .event-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--text-color);
      margin-bottom: var(--spacing-sm);
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .event-title::before {
      content: '\f073';
      font-family: "Font Awesome 5 Free";
      font-weight: 900;
      color: var(--primary-color);
      font-size: 1.1em;
    }

    .event-detail {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: var(--spacing-sm);
      font-size: 0.95rem;
      padding: 0.25rem 0;
    }

    .event-label {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      min-width: 90px;
      color: #64748b;
    }

    .event-label i {
      width: 20px;
      text-align: center;
    }

    .category-badge {
      position: absolute;
      top: 1rem;
      right: -26px;
      background: var(--secondary-color);
      color: white;
      padding: 0.25rem 1.5rem;
      transform: rotate(45deg);
      font-size: 0.75rem;
      font-weight: 500;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .empty-state {
      text-align: center;
      padding: var(--spacing-lg);
      color: #64748b;
    }

    .empty-state i {
      font-size: 3rem;
      margin-bottom: var(--spacing-sm);
      color: #cbd5e1;
    }

    @media (max-width: 768px) {
      .container {
        padding: var(--spacing-sm);
      }

      .event-card {
        margin: 0 0.5rem;
      }
    }
  </style>
</head>
<body>
  <x-layout>
    <div class="container py-md-5">
      <div class="filters">
        <form method="GET" action="{{ route('allevents') }}">
          <input type="hidden" name="type" value="{{ $selectedType }}">
          <input type="hidden" name="day" value="{{ $selectedDay }}">
          <div class="filter-groups">
            <div class="filter-group">
              <button type="submit" name="day" value="1" class="filter-button {{ $selectedDay == 1 ? 'active-filter' : '' }}">Day 1</button>
              <button type="submit" name="day" value="2" class="filter-button {{ $selectedDay == 2 ? 'active-filter' : '' }}">Day 2</button>
              <button type="submit" name="day" value="3" class="filter-button {{ $selectedDay == 3 ? 'active-filter' : '' }}">Day 3</button>
            </div>
            <div class="filter-group">
              <button type="submit" name="type" value="technical" class="filter-button {{ $selectedType == 'technical' ? 'active-filter' : '' }}">Technical</button>
              <button type="submit" name="type" value="seminar" class="filter-button {{ $selectedType == 'seminar' ? 'active-filter' : '' }}">Seminar</button>
              <button type="submit" name="type" value="cultural" class="filter-button {{ $selectedType == 'cultural' ? 'active-filter' : '' }}">Cultural</button>
            </div>
          </div>
        </form>
      </div>

      @if($events->count() > 0)
      <div class="events-grid">
        @foreach($events as $event)
        <a href="{{ route('event.show', $event->id) }}" class="event-link">
          <div class="event-card">
            <h2 class="event-title">{{ $event->eventName }}</h2>
            <div class="event-detail">
              <span class="event-label">
                <i class="fas fa-tag"></i>Category:
              </span>
              {{ $event->eventCategory }}
            </div>
            <div class="event-detail">
              <span class="event-label">
                <i class="fas fa-clock"></i>Time:
              </span>
              {{ $event->startTime }} - {{ $event->endTime }}
            </div>
            <div class="event-detail">
              <span class="event-label">
                <i class="fas fa-rupee-sign"></i>Fees:
              </span>
              ₹{{ $event->entryFees }}
            </div>
          </div>
        </a>
        @endforeach
      </div>
      @else
      <div class="empty-state">
        <i class="fas fa-calendar-times"></i>
        <h3>No events found</h3>
        <p>Try adjusting your filters</p>
      </div>
      @endif
    </div>

    
  </x-layout>
</body>
</html>
