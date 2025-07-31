<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Sutra</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    :root {
      --primary: #2563eb;
      --dark: #1e293b;
      --gray: #64748b;
      --light: #f8fafc;
      --white: #fff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: var(--light);
      color: var(--dark);
      line-height: 1.6;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      padding: 1rem 2rem;
      background: var(--white);
      box-shadow: 0 1px 4px rgba(0,0,0,0.05);
      text-align: center;
    }

    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary);
    }

    .tagline {
      font-size: 0.9rem;
      color: var(--gray);
      margin-top: 0.25rem;
    }

    .hero {
      background: linear-gradient(135deg, var(--primary), #3b82f6);
      color: var(--white);
      text-align: center;
      padding: 3rem 1rem 4rem;
    }

    .hero h1 {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 0.75rem;
    }

    .hero p {
      font-size: 1rem;
      opacity: 0.9;
      max-width: 600px;
      margin: 0 auto 1.5rem;
    }

    .hero .buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .btn {
      border: none;
      padding: 0.6rem 1.5rem;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      font-size: 1rem;
      transition: 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-primary {
      background: var(--white);
      color: var(--primary);
    }

    .btn-primary:hover {
      background: #f1f5f9;
    }

    .btn-outline {
      background: transparent;
      color: var(--white);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 1.5rem;
      padding: 3rem 1rem;
      max-width: 1100px;
      margin: auto;
    }

    .feature {
      background: var(--white);
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
      text-align: center;
      transition: 0.2s ease;
    }

    .feature:hover {
      transform: translateY(-4px);
    }

    .feature i {
      font-size: 1.5rem;
      color: var(--primary);
      margin-bottom: 0.75rem;
    }

    .feature h3 {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .feature p {
      font-size: 0.9rem;
      color: var(--gray);
    }

    footer {
      margin-top: auto;
      padding: 2rem 1rem;
      background: var(--dark);
      text-align: center;
      color: var(--white);
    }

    .footer-links {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
      margin-bottom: 1rem;
    }

    .footer-links a {
      color: var(--white);
      font-size: 0.9rem;
      opacity: 0.7;
      text-decoration: none;
      transition: 0.2s;
    }

    .footer-links a:hover {
      opacity: 1;
    }

    .copyright {
      font-size: 0.8rem;
      opacity: 0.6;
    }

    @media (max-width: 600px) {
      .hero h1 {
        font-size: 1.7rem;
      }

      .features {
        padding: 2rem 1rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">School Sutra</div>
    <div class="tagline">Smart School Management</div>
  </header>

  <section class="hero">
    <h1>Run Your School Smarter</h1>
    <p>One platform for managing students, teachers, schedules, finances, and more.</p>
    <div class="buttons">
      <button class="btn btn-primary" onclick="location.href='{{route('login')}}'">
        <i class="fas fa-sign-in-alt"></i> Login
      </button>
      <button class="btn btn-outline" onclick="location.href='#features'">
        <i class="fas fa-info-circle"></i> Learn More
      </button>
    </div>
  </section>

  <section id="features" class="features">
    <div class="feature">
      <i class="fas fa-user-graduate"></i>
      <h3>Student Management</h3>
      <p>Manage student records, progress, and guardian info with ease.</p>
    </div>
    <div class="feature">
      <i class="fas fa-chalkboard-teacher"></i>
      <h3>Teacher Tools</h3>
      <p>Simple attendance, grading, and communication features.</p>
    </div>
    <div class="feature">
      <i class="fas fa-calendar-alt"></i>
      <h3>Smart Timetables</h3>
      <p>Automate your schedules and manage events seamlessly.</p>
    </div>
    <div class="feature">
      <i class="fas fa-file-invoice-dollar"></i>
      <h3>Fee Tracking</h3>
      <p>Track payments and invoices without the paperwork.</p>
    </div>
    <div class="feature">
      <i class="fas fa-bus"></i>
      <h3>Transport</h3>
      <p>Plan routes and track student pick-up and drop-off.</p>
    </div>
    <div class="feature">
      <i class="fas fa-users"></i>
      <h3>Parent Access</h3>
      <p>Let parents view student progress and school news anytime.</p>
    </div>
  </section>

  <footer>
    <div class="footer-links">
      <a href="#">About</a>
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">Contact</a>
    </div>
    <div class="copyright">
      &copy; 2025 School Sutra. All rights reserved.
    </div>
  </footer>
</body>
</html>
