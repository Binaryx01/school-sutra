<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Sutra | Smart School Management</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary: #3b82f6;
      --secondary: #60a5fa;
      --dark: #1e293b;
      --light: #f1f5f9;
      --accent: #0284c7;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(to bottom right, #e0f2fe, #f8fafc);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .header {
      background: var(--dark);
      color: white;
      padding: 2rem 1rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .logo {
      font-size: 2.7rem;
      font-weight: 800;
      margin-bottom: 0.4rem;
      background: linear-gradient(to right, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .tagline {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .welcome-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 1200px;
      margin: 2rem 0;
      overflow: hidden;
    }

    .hero-section {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      text-align: center;
      padding: 3rem 2rem;
    }

    .hero-title {
      font-size: 2.7rem;
      margin-bottom: 1rem;
    }

    .hero-subtitle {
      font-size: 1.15rem;
      margin-bottom: 2rem;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .cta-buttons {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn {
      padding: 0.9rem 2rem;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1rem;
      border: none;
    }

    .btn-primary {
      background: white;
      color: var(--primary);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-secondary {
      background: transparent;
      color: white;
      border: 2px solid white;
    }

    .btn-secondary:hover {
      background: rgba(255,255,255,0.1);
    }

    .features-section {
      padding: 3rem 2rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      background-color: #f9fbfc;
    }

    .feature-card {
      background: var(--light);
      border-radius: 12px;
      padding: 2rem;
      border-left: 4px solid var(--primary);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
      opacity: 0;
      transform: translateY(20px);
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    }

    .feature-icon {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 1rem;
    }

    .feature-title {
      font-size: 1.4rem;
      color: var(--dark);
      margin-bottom: 0.6rem;
    }

    .feature-desc {
      color: #64748b;
      line-height: 1.6;
    }

    .footer {
      background: var(--dark);
      color: white;
      padding: 2rem 1rem;
      text-align: center;
    }

    .footer-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
      margin: 1.2rem 0;
    }

    .footer-link {
      color: white;
      text-decoration: none;
      transition: color 0.3s;
    }

    .footer-link:hover {
      color: var(--accent);
    }

    .copyright {
      font-size: 0.85rem;
      opacity: 0.8;
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }

      .cta-buttons {
        flex-direction: column;
        width: 100%;
        align-items: center;
      }

      .btn {
        width: 100%;
        max-width: 300px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="logo">School Sutra</div>
    <div class="tagline">Smart School Management for the Future</div>
  </header>

  <!-- Main Content -->
  <main class="main-content">
    <div class="welcome-container">

      <!-- Hero Section -->
      <section class="hero-section">
        <h1 class="hero-title">Welcome to School Sutra</h1>
        <p class="hero-subtitle">
          A modern and intuitive platform to manage students, teachers, classes, finances, and more — all in one place.
        </p>
        <div class="cta-buttons">
          <button class="btn btn-primary" onclick="location.href='{{route('login')}}'">
            <i class="fas fa-sign-in-alt"></i> Login
          </button>
          <button class="btn btn-secondary" onclick="location.href='#features'">
            <i class="fas fa-info-circle"></i> Learn More
          </button>
        </div>
      </section>

      <!-- Features Section -->
      <section class="features-section" id="features">
        <div class="feature-card">
          <div class="feature-icon"><i class="fas fa-user-graduate"></i></div>
          <h3 class="feature-title">Student Management</h3>
          <p class="feature-desc">
            Maintain detailed student profiles, class assignments, guardians, and academic records with ease.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon"><i class="fas fa-chalkboard-teacher"></i></div>
          <h3 class="feature-title">Teacher Dashboard</h3>
          <p class="feature-desc">
            Empower teachers with tools for attendance, grades, communication, and scheduling.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
          <h3 class="feature-title">Timetable & Events</h3>
          <p class="feature-desc">
            Organize academic calendars, class schedules, and school-wide events from a single dashboard.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon"><i class="fas fa-file-invoice-dollar"></i></div>
          <h3 class="feature-title">Finance & Fees</h3>
          <p class="feature-desc">
            Track payments, generate invoices, and manage expenses with full transparency and reports.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon"><i class="fas fa-bus"></i></div>
          <h3 class="feature-title">Transport Management</h3>
          <p class="feature-desc">
            Assign bus routes, monitor student pickups, and optimize school transportation logistics.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon"><i class="fas fa-users"></i></div>
          <h3 class="feature-title">Parent Portal</h3>
          <p class="feature-desc">
            Give parents real-time access to student attendance, academic updates, and announcements.
          </p>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-links">
      <a href="#" class="footer-link">About</a>
      <a href="#" class="footer-link">Privacy Policy</a>
      <a href="#" class="footer-link">Terms</a>
      <a href="#" class="footer-link">Support</a>
    </div>
    <div class="copyright">
      &copy; 2025 School Sutra. All rights reserved.
    </div>
  </footer>

  <!-- Animate Cards on Scroll -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const cards = document.querySelectorAll('.feature-card');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, { threshold: 0.1 });

      cards.forEach(card => {
        observer.observe(card);
      });
    });
  </script>
</body>
</html>
