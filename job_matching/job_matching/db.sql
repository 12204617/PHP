CREATE DATABASE job_platform;

use job_platform;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    skills VARCHAR(255)
);

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(100),
    job_description TEXT,
    skills_required VARCHAR(255)
);
INSERT INTO jobs (job_title, job_description, skills_required)
VALUES
('PHP Developer', 'Build dynamic websites using PHP and MySQL', 'PHP, MySQL'),
('Frontend Developer', 'Create UI designs using HTML, CSS, and JavaScript', 'HTML, CSS, JavaScript'),
('Backend Developer', 'Develop server-side logic using Node.js and databases', 'Node.js, SQL'),
('Data Analyst', 'Analyze datasets and generate reports using Python and SQL', 'Python, SQL'),
('Mobile App Developer', 'Build mobile applications using Flutter or React Native', 'Flutter, React Native'),
('Machine Learning Engineer', 'Develop predictive models using Python and TensorFlow', 'Python, TensorFlow, Machine Learning'),
('Full Stack Developer', 'Develop end-to-end applications using PHP, JavaScript, and MySQL', 'PHP, JavaScript, MySQL'),
('System Administrator', 'Manage servers and deploy applications on Linux systems', 'Linux, Bash, Networking'),
('DevOps Engineer', 'Implement CI/CD pipelines using Docker and Kubernetes', 'Docker, Kubernetes, CI/CD'),
('Content Writer', 'Create engaging content for blogs and websites', 'Content Writing, SEO, WordPress');
