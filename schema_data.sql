SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS A5;
USE A5;

-- Organisations table for partner organizations
CREATE TABLE `organisations` (
  `id` char(36) NOT NULL,
  `org_name` varchar(100) NOT NULL,
  `business_address` text NOT NULL,
  `contact_person_full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `help_description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volunteers table for volunteer management
CREATE TABLE `volunteers` (
  `id` char(36) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `skills` text NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `documents` varchar(255),
  `availability` text,
  `self_intro` text,
  `date_submitted` date,
  `status` enum('inactive','active') NOT NULL DEFAULT 'inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Users table for system access
CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','assistant','volunteer') NOT NULL DEFAULT 'volunteer',
  `volunteer_id` char(36) NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Events table for community events
CREATE TABLE `events` (
  `id` char(36) NOT NULL,
  `title` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `host` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_size` int(11) NOT NULL,
  `contact_person_full_name` varchar(100) NOT NULL,
  `contact_person_email` varchar(100) NOT NULL,
  `event_description` text NOT NULL,
  `required_equipment` text,
  `required_skills` text,
  `number_of_required_crews` int(11) NOT NULL,
  `status` enum('Preparing','Ready to go','Archive','Failed') NOT NULL DEFAULT 'Preparing',
  `organisation_id` char(36) NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volunteer_Events junction table for many-to-many relationship
CREATE TABLE `volunteer_events` (
  `id` char(36) NOT NULL,
  `event_id` char(36) NOT NULL,
  `volunteer_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Contact messages table for storing contact form submissions
CREATE TABLE `contact_messages` (
  `id` char(36) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `is_replied` boolean NOT NULL DEFAULT FALSE,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volunteer signups table for public volunteer registrations
CREATE TABLE `volunteer_signups` (
  `id` char(36) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `skills` text NOT NULL,
  `interests` text,
  `message` text,
  `profile_picture` varchar(255) NOT NULL,
  `documents` varchar(255),
  `status` enum('pending','hired','declined') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert ALL sample data from A3

-- Users table - Only Amy as admin user initially
-- Password: AmyTan123 (hashed using PHP password_hash function)
-- Other users (assistants, volunteers) will be added through the application's user management pages
INSERT INTO `users` (`id`, `username`, `password`, `role`, `volunteer_id`, `created`, `modified`) VALUES 
('550e8400-e29b-41d4-a716-446655440000', 'AmyTan', '$2y$12$pS.1QtYTcqPdb.j541h.8OL1iCe5Fe5Evjia.c9Dv0Lsp2YNO/Goq', 'admin', NULL, NOW(), NOW());

-- ALL Sample organisations from A3
INSERT INTO `organisations` (`id`, `org_name`, `business_address`, `contact_person_full_name`, `email`, `phone`, `industry`, `help_description`, `created`, `modified`) VALUES
('550e8400-e29b-41d4-a716-446655440001', 'Local Community Center', '123 Main Street, Melbourne VIC 3000', 'Sarah Johnson', 'sarah.johnson@communitycenter.org', '0412 345 678', 'Community Services', 'Event venue, community programs, youth activities', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440002', 'Green Earth Initiative', '456 Green Lane, Melbourne VIC 3001', 'Michael Chen', 'michael.chen@greenearth.org', '0423 456 789', 'Environmental', 'Environmental workshops, sustainability programs, tree planting', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440003', 'Arts & Culture Society', '789 Art Avenue, Melbourne VIC 3002', 'Emma Wilson', 'emma.wilson@artsculture.org', '0434 567 890', 'Arts & Culture', 'Art exhibitions, cultural events, creative workshops', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440004', 'Youth Development Foundation', '321 Youth Street, Melbourne VIC 3003', 'David Brown', 'david.brown@youthdev.org', '0445 678 901', 'Youth Services', 'Youth leadership programs, mentoring, career development', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440005', 'Senior Citizens Club', '654 Senior Way, Melbourne VIC 3004', 'Margaret Davis', 'margaret.davis@seniors.org', '0456 789 012', 'Senior Services', 'Senior activities, health programs, social events', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440006', 'Sports & Recreation Club', '987 Sports Boulevard, Melbourne VIC 3005', 'James Miller', 'james.miller@sports.org', '0467 890 123', 'Sports & Recreation', 'Sports tournaments, fitness programs, recreational activities', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440007', 'Environmental Protection Group', '147 Eco Street, Melbourne VIC 3006', 'Lisa Anderson', 'lisa.anderson@envprotect.org', '0478 901 234', 'Environmental', 'Environmental protection, conservation programs, awareness campaigns', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440008', 'Education Support Network', '258 Education Lane, Melbourne VIC 3007', 'Robert Taylor', 'robert.taylor@edusupport.org', '0489 012 345', 'Education', 'Educational support, tutoring programs, learning resources', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440009', 'Health & Wellness Association', '369 Health Avenue, Melbourne VIC 3008', 'Jennifer White', 'jennifer.white@healthwell.org', '0490 123 456', 'Health & Wellness', 'Health screenings, wellness programs, medical support', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440010', 'Business Development Council', '741 Business Plaza, Melbourne VIC 3009', 'Thomas Garcia', 'thomas.garcia@business.org', '0401 234 567', 'Business', 'Business networking, development programs, entrepreneurship support', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440011', 'Cultural Heritage Society', '852 Heritage Square, Melbourne VIC 3010', 'Amanda Rodriguez', 'amanda.rodriguez@heritage.org', '0412 345 678', 'Cultural Heritage', 'Cultural preservation, heritage programs, traditional arts', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440012', 'Technology Innovation Hub', '963 Tech Center, Melbourne VIC 3011', 'Christopher Lee', 'christopher.lee@techhub.org', '0423 456 789', 'Technology', 'Tech innovation, digital programs, startup support', NOW(), NOW());

-- ALL Sample volunteers from A3
INSERT INTO `volunteers` (`id`, `first_name`, `last_name`, `email`, `phone`, `skills`, `profile_picture`, `documents`, `availability`, `self_intro`, `date_submitted`, `status`, `created`, `modified`) VALUES
('550e8400-e29b-41d4-a716-446655440020', 'Alice', 'Thompson', 'alice.thompson@email.com', '0411 111 111', 'Event planning, Customer service, First aid', 'volunteer_profiles/alice_thompson.jpg', 'alice_documents.pdf', 'Weekends, Evenings', 'I am passionate about community service and have 3 years experience in event coordination.', '2024-01-15', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440021', 'Bob', 'Martinez', 'bob.martinez@email.com', '0412 222 222', 'Marketing, Social media, Photography', 'volunteer_profiles/bob_martinez.jpg', 'bob_documents.pdf', 'Weekdays, Mornings', 'Creative professional with expertise in digital marketing and social media management.', '2024-01-20', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440022', 'Carol', 'Williams', 'carol.williams@email.com', '0413 333 333', 'Teaching, Childcare, Arts and crafts', 'volunteer_profiles/carol_williams.jpg', 'carol_documents.pdf', 'Weekends, School holidays', 'Experienced teacher with passion for working with children and community education.', '2024-02-01', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440023', 'Daniel', 'Kim', 'daniel.kim@email.com', '0414 444 444', 'IT support, Website design, Data analysis', 'volunteer_profiles/daniel_kim.jpg', 'daniel_documents.pdf', 'Flexible', 'IT professional looking to contribute technical skills to community projects.', '2024-02-10', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440024', 'Eva', 'Rodriguez', 'eva.rodriguez@email.com', '0415 555 555', 'Spanish translation, Event coordination, Fundraising', 'volunteer_profiles/eva_rodriguez.jpg', 'eva_documents.pdf', 'Evenings, Weekends', 'Bilingual professional with experience in community outreach and fundraising.', '2024-02-15', 'inactive', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440025', 'Frank', 'Johnson', 'frank.johnson@email.com', '0416 666 666', 'Sports coaching, First aid, Team building', 'volunteer_profiles/frank_johnson.jpg', 'frank_documents.pdf', 'Weekends, Evenings', 'Sports coach with first aid certification and team building expertise.', '2024-02-20', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440026', 'Grace', 'Lee', 'grace.lee@email.com', '0417 777 777', 'Graphic design, Social media, Content creation', 'volunteer_profiles/grace_lee.jpg', 'grace_documents.pdf', 'Flexible', 'Creative designer with social media and content creation skills.', '2024-02-25', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440027', 'Henry', 'Chen', 'henry.chen@email.com', '0418 888 888', 'Accounting, Financial planning, Budget management', 'volunteer_profiles/henry_chen.jpg', 'henry_documents.pdf', 'Weekdays', 'Financial professional with expertise in accounting and budget management.', '2024-03-01', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440028', 'Iris', 'Patel', 'iris.patel@email.com', '0419 999 999', 'Hindi translation, Cultural events, Community outreach', 'volunteer_profiles/iris_patel.jpg', 'iris_documents.pdf', 'Weekends, Evenings', 'Multilingual professional with cultural event and community outreach experience.', '2024-03-05', 'inactive', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440029', 'Jack', 'Wilson', 'jack.wilson@email.com', '0420 000 000', 'Construction, Handyman work, Safety training', 'volunteer_profiles/jack_wilson.jpg', 'jack_documents.pdf', 'Weekdays, Weekends', 'Construction worker with safety training and handyman skills.', '2024-03-10', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440030', 'Kate', 'Anderson', 'kate.anderson@email.com', '0421 111 222', 'Nursing, Health education, Patient care', 'volunteer_profiles/kate_anderson.jpg', 'kate_documents.pdf', 'Flexible', 'Registered nurse with health education and patient care experience.', '2024-03-15', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440031', 'Liam', 'O\'Connor', 'liam.oconnor@email.com', '0422 222 333', 'Music, Sound engineering, Performance', 'volunteer_profiles/liam_oconnor.jpg', 'liam_documents.pdf', 'Evenings, Weekends', 'Musician and sound engineer with performance and technical expertise.', '2024-03-20', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440032', 'Maya', 'Singh', 'maya.singh@email.com', '0423 333 444', 'Yoga instruction, Meditation, Wellness coaching', 'volunteer_profiles/maya_singh.jpg', 'maya_documents.pdf', 'Mornings, Weekends', 'Certified yoga instructor with meditation and wellness coaching experience.', '2024-03-25', 'active', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440033', 'Noah', 'Brown', 'noah.brown@email.com', '0424 444 555', 'Carpentry, Woodworking, Tool maintenance', 'volunteer_profiles/noah_brown.jpg', 'noah_documents.pdf', 'Weekdays', 'Skilled carpenter with woodworking and tool maintenance expertise.', '2024-03-30', 'inactive', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440034', 'Olivia', 'Davis', 'olivia.davis@email.com', '0425 555 666', 'Public speaking, Leadership training, Mentoring', 'volunteer_profiles/olivia_davis.jpg', 'olivia_documents.pdf', 'Flexible', 'Leadership trainer with public speaking and mentoring experience.', '2024-04-01', 'active', NOW(), NOW());

-- ALL Sample events from A3
INSERT INTO `events` (`id`, `title`, `location`, `host`, `event_date`, `event_size`, `contact_person_full_name`, `contact_person_email`, `event_description`, `required_equipment`, `required_skills`, `number_of_required_crews`, `status`, `organisation_id`, `created`, `modified`) VALUES
('550e8400-e29b-41d4-a716-446655440040', 'Spring Community Market', 'Central Park', 'Sarah Johnson', '2025-03-15', 200, 'Sarah Johnson', 'sarah.johnson@communitycenter.org', 'Join us for our annual spring market featuring local vendors, food stalls, and live entertainment. A perfect day out for the whole family with activities for children and adults alike.', 'Tables, Chairs, Sound system, Tents', 'Event coordination, Customer service, Setup/cleanup', 15, 'Ready to go', '550e8400-e29b-41d4-a716-446655440001', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440041', 'Environmental Workshop', 'Green Earth Center', 'Michael Chen', '2025-03-20', 50, 'Michael Chen', 'michael.chen@greenearth.org', 'Learn about sustainable living practices, composting, and eco-friendly home solutions. Hands-on activities and take-home materials provided.', 'Projector, Whiteboard, Workshop materials', 'Environmental knowledge, Teaching, Group facilitation', 5, 'Preparing', '550e8400-e29b-41d4-a716-446655440002', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440042', 'Art Exhibition Opening', 'City Gallery', 'Emma Wilson', '2025-03-25', 100, 'Emma Wilson', 'emma.wilson@artsculture.org', 'Opening night of our local artists showcase featuring paintings, sculptures, and digital art. Refreshments provided, meet the artists.', 'Display stands, Lighting, Audio equipment', 'Art knowledge, Customer service, Event coordination', 8, 'Ready to go', '550e8400-e29b-41d4-a716-446655440003', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440043', 'Youth Leadership Seminar', 'Community Hall', 'David Brown', '2025-04-01', 75, 'David Brown', 'david.brown@youthdev.org', 'Interactive workshop for young people aged 16-25 focusing on leadership skills, public speaking, and community engagement.', 'Projector, Microphones, Workshop materials', 'Youth mentoring, Leadership training, Public speaking', 6, 'Preparing', '550e8400-e29b-41d4-a716-446655440004', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440044', 'Senior Fitness Class', 'Senior Center', 'Margaret Davis', '2025-04-05', 30, 'Margaret Davis', 'margaret.davis@seniors.org', 'Low-impact exercise class designed for seniors, including stretching, balance exercises, and gentle aerobics. All fitness levels welcome.', 'Exercise mats, Light weights, Music system', 'Fitness instruction, Senior care, Health knowledge', 3, 'Ready to go', '550e8400-e29b-41d4-a716-446655440005', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440045', 'Sports Tournament', 'Sports Complex', 'James Miller', '2025-04-10', 150, 'James Miller', 'james.miller@sports.org', 'Annual community sports tournament featuring soccer, basketball, and volleyball. Teams and individual players welcome to register.', 'Sports equipment, Scoreboards, First aid supplies', 'Sports coaching, First aid, Event coordination', 10, 'Ready to go', '550e8400-e29b-41d4-a716-446655440006', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440046', 'Tree Planting Day', 'Riverside Park', 'Lisa Anderson', '2025-04-15', 80, 'Lisa Anderson', 'lisa.anderson@envprotect.org', 'Community tree planting event to improve our local environment. Tools and saplings provided, suitable for all ages.', 'Shovels, Saplings, Safety equipment', 'Environmental knowledge, Physical work, Safety awareness', 8, 'Preparing', '550e8400-e29b-41d4-a716-446655440007', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440047', 'Parenting Workshop', 'Education Center', 'Robert Taylor', '2025-04-20', 40, 'Robert Taylor', 'robert.taylor@edusupport.org', 'Support group and workshop for parents covering topics like positive discipline, communication, and stress management.', 'Projector, Workshop materials, Refreshments', 'Teaching, Parenting knowledge, Group facilitation', 4, 'Preparing', '550e8400-e29b-41d4-a716-446655440008', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440048', 'Health Fair', 'Community Center', 'Jennifer White', '2025-04-25', 120, 'Jennifer White', 'jennifer.white@healthwell.org', 'Free health screenings, nutrition advice, and wellness information from local health professionals.', 'Medical equipment, Information booths, Chairs', 'Health knowledge, Customer service, Medical support', 12, 'Ready to go', '550e8400-e29b-41d4-a716-446655440009', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440049', 'Business Networking Event', 'Conference Center', 'Thomas Garcia', '2025-05-01', 100, 'Thomas Garcia', 'thomas.garcia@business.org', 'Networking opportunity for local business owners and entrepreneurs. Includes keynote speaker and refreshments.', 'Microphones, Projector, Networking materials', 'Business knowledge, Networking, Event coordination', 6, 'Preparing', '550e8400-e29b-41d4-a716-446655440010', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440050', 'Cultural Festival', 'Town Square', 'Amanda Rodriguez', '2025-05-05', 300, 'Amanda Rodriguez', 'amanda.rodriguez@heritage.org', 'Celebration of our diverse community with traditional music, dance, food, and cultural displays from around the world.', 'Sound system, Stage, Cultural displays', 'Cultural knowledge, Event coordination, Customer service', 20, 'Ready to go', '550e8400-e29b-41d4-a716-446655440011', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440051', 'Tech Innovation Showcase', 'Innovation Hub', 'Christopher Lee', '2025-05-10', 80, 'Christopher Lee', 'christopher.lee@techhub.org', 'Showcase of local technology startups and innovative projects. Demonstrations, presentations, and networking opportunities.', 'Projectors, Demo equipment, Networking materials', 'Technology knowledge, Event coordination, Technical support', 8, 'Preparing', '550e8400-e29b-41d4-a716-446655440012', NOW(), NOW());

-- ALL Sample volunteer-event assignments from A3
INSERT INTO `volunteer_events` (`id`, `event_id`, `volunteer_id`, `created`, `modified`) VALUES
('550e8400-e29b-41d4-a716-446655440060', '550e8400-e29b-41d4-a716-446655440040', '550e8400-e29b-41d4-a716-446655440020', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440061', '550e8400-e29b-41d4-a716-446655440040', '550e8400-e29b-41d4-a716-446655440021', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440062', '550e8400-e29b-41d4-a716-446655440040', '550e8400-e29b-41d4-a716-446655440022', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440063', '550e8400-e29b-41d4-a716-446655440041', '550e8400-e29b-41d4-a716-446655440023', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440064', '550e8400-e29b-41d4-a716-446655440041', '550e8400-e29b-41d4-a716-446655440024', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440065', '550e8400-e29b-41d4-a716-446655440041', '550e8400-e29b-41d4-a716-446655440025', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440066', '550e8400-e29b-41d4-a716-446655440042', '550e8400-e29b-41d4-a716-446655440026', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440067', '550e8400-e29b-41d4-a716-446655440042', '550e8400-e29b-41d4-a716-446655440027', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440068', '550e8400-e29b-41d4-a716-446655440042', '550e8400-e29b-41d4-a716-446655440028', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440069', '550e8400-e29b-41d4-a716-446655440043', '550e8400-e29b-41d4-a716-446655440029', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440070', '550e8400-e29b-41d4-a716-446655440043', '550e8400-e29b-41d4-a716-446655440030', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440071', '550e8400-e29b-41d4-a716-446655440043', '550e8400-e29b-41d4-a716-446655440031', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440072', '550e8400-e29b-41d4-a716-446655440044', '550e8400-e29b-41d4-a716-446655440032', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440073', '550e8400-e29b-41d4-a716-446655440044', '550e8400-e29b-41d4-a716-446655440033', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440074', '550e8400-e29b-41d4-a716-446655440044', '550e8400-e29b-41d4-a716-446655440034', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440075', '550e8400-e29b-41d4-a716-446655440045', '550e8400-e29b-41d4-a716-446655440020', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440076', '550e8400-e29b-41d4-a716-446655440045', '550e8400-e29b-41d4-a716-446655440025', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440077', '550e8400-e29b-41d4-a716-446655440045', '550e8400-e29b-41d4-a716-446655440029', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440078', '550e8400-e29b-41d4-a716-446655440046', '550e8400-e29b-41d4-a716-446655440021', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440079', '550e8400-e29b-41d4-a716-446655440046', '550e8400-e29b-41d4-a716-446655440023', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440080', '550e8400-e29b-41d4-a716-446655440046', '550e8400-e29b-41d4-a716-446655440027', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440081', '550e8400-e29b-41d4-a716-446655440047', '550e8400-e29b-41d4-a716-446655440022', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440082', '550e8400-e29b-41d4-a716-446655440047', '550e8400-e29b-41d4-a716-446655440026', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440083', '550e8400-e29b-41d4-a716-446655440047', '550e8400-e29b-41d4-a716-446655440031', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440084', '550e8400-e29b-41d4-a716-446655440048', '550e8400-e29b-41d4-a716-446655440024', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440085', '550e8400-e29b-41d4-a716-446655440048', '550e8400-e29b-41d4-a716-446655440028', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440086', '550e8400-e29b-41d4-a716-446655440048', '550e8400-e29b-41d4-a716-446655440032', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440087', '550e8400-e29b-41d4-a716-446655440049', '550e8400-e29b-41d4-a716-446655440031', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440088', '550e8400-e29b-41d4-a716-446655440049', '550e8400-e29b-41d4-a716-446655440033', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440089', '550e8400-e29b-41d4-a716-446655440049', '550e8400-e29b-41d4-a716-446655440034', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440090', '550e8400-e29b-41d4-a716-446655440050', '550e8400-e29b-41d4-a716-446655440020', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440091', '550e8400-e29b-41d4-a716-446655440050', '550e8400-e29b-41d4-a716-446655440022', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440092', '550e8400-e29b-41d4-a716-446655440050', '550e8400-e29b-41d4-a716-446655440024', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440093', '550e8400-e29b-41d4-a716-446655440051', '550e8400-e29b-41d4-a716-446655440021', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440094', '550e8400-e29b-41d4-a716-446655440051', '550e8400-e29b-41d4-a716-446655440023', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440095', '550e8400-e29b-41d4-a716-446655440051', '550e8400-e29b-41d4-a716-446655440025', NOW(), NOW());

-- ALL Sample contact messages from A3
INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `phone`, `message`, `is_replied`, `created`, `modified`) VALUES
('550e8400-e29b-41d4-a716-446655440100', 'John', 'Smith', 'john.smith@email.com', '0401 234 567', 'I would like to volunteer for the upcoming community market. I have experience in event management and would love to help out.', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440101', 'Mary', 'Johnson', 'mary.johnson@email.com', '0402 345 678', 'I am interested in learning more about volunteer opportunities for teenagers. My daughter is 16 and looking to get involved in community service.', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440102', 'Peter', 'Brown', 'peter.brown@email.com', '0403 456 789', 'I would like to know if there are any upcoming workshops on sustainable living. I am passionate about environmental conservation.', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440103', 'Lisa', 'Davis', 'lisa.davis@email.com', '0404 567 890', 'I am a local business owner and would like to participate in the business networking event. Please send me more information about registration.', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440104', 'David', 'Wilson', 'david.wilson@email.com', '0405 678 901', 'I have some questions about the youth leadership seminar. What age groups are eligible and what is the cost to attend?', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440105', 'Sarah', 'Miller', 'sarah.miller@email.com', '0406 789 012', 'I would like to volunteer for the health fair. I am a registered nurse and can help with health screenings.', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440106', 'Michael', 'Garcia', 'michael.garcia@email.com', '0407 890 123', 'I am interested in sponsoring one of your events. Could you please provide information about sponsorship opportunities?', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440107', 'Emma', 'Taylor', 'emma.taylor@email.com', '0408 901 234', 'I would like to know more about the cultural festival. Are there opportunities for local performers to participate?', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440108', 'James', 'Anderson', 'james.anderson@email.com', '0409 012 345', 'I am looking for volunteer opportunities in the arts and culture sector. Do you have any positions available?', FALSE, NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440109', 'Jennifer', 'Lee', 'jennifer.lee@email.com', '0410 123 456', 'I would like to donate some art supplies for your workshops. Who should I contact to arrange this?', FALSE, NOW(), NOW());

-- ALL Sample volunteer signups from A3
INSERT INTO `volunteer_signups` (`id`, `first_name`, `last_name`, `email`, `phone`, `skills`, `interests`, `message`, `profile_picture`, `documents`, `status`, `created`, `modified`) VALUES
('550e8400-e29b-41d4-a716-446655440110', 'Alex', 'Thompson', 'alex.thompson@email.com', '0409 012 345', 'Event coordination, Social media marketing', 'Community events, Environmental causes', 'I am passionate about community service and would love to volunteer for local events. I have experience in event planning and social media.', 'volunteer_profiles/alex_thompson_signup.jpg', 'alex_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440111', 'Sam', 'Johnson', 'sam.johnson@email.com', '0410 123 456', 'Teaching, Public speaking, Leadership', 'Youth development, Education', 'I am a teacher with 5 years of experience and would like to volunteer for youth programs and educational workshops.', 'volunteer_profiles/sam_johnson_signup.jpg', 'sam_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440112', 'Jordan', 'Lee', 'jordan.lee@email.com', '0411 234 567', 'Graphic design, Photography, Social media', 'Arts and culture, Marketing', 'I am a creative professional looking to contribute my design and photography skills to community events and cultural programs.', 'volunteer_profiles/jordan_lee_signup.jpg', 'jordan_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440113', 'Casey', 'Brown', 'casey.brown@email.com', '0412 345 678', 'First aid, Sports coaching, Team building', 'Health and wellness, Sports', 'I am a certified first aid instructor and sports coach interested in volunteering for health fairs and sports events.', 'volunteer_profiles/casey_brown_signup.jpg', 'casey_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440114', 'Taylor', 'Wilson', 'taylor.wilson@email.com', '0413 456 789', 'Translation (Spanish), Cultural events, Community outreach', 'Cultural diversity, Language support', 'I am bilingual in English and Spanish and would like to help with cultural events and provide language support for diverse communities.', 'volunteer_profiles/taylor_wilson_signup.jpg', 'taylor_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440115', 'Morgan', 'Davis', 'morgan.davis@email.com', '0414 567 890', 'IT support, Website development, Data analysis', 'Technology, Innovation', 'I am a software developer interested in volunteering for tech events and helping organizations with their digital needs.', 'volunteer_profiles/morgan_davis_signup.jpg', 'morgan_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440116', 'Riley', 'Garcia', 'riley.garcia@email.com', '0415 678 901', 'Music, Sound engineering, Performance', 'Arts and entertainment, Music education', 'I am a musician and sound engineer looking to volunteer for cultural events and music programs.', 'volunteer_profiles/riley_garcia_signup.jpg', 'riley_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440117', 'Quinn', 'Martinez', 'quinn.martinez@email.com', '0416 789 012', 'Cooking, Food safety, Event planning', 'Food and hospitality, Community events', 'I am a chef with food safety certification interested in volunteering for community markets and food-related events.', 'volunteer_profiles/quinn_martinez_signup.jpg', 'quinn_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440118', 'Avery', 'Taylor', 'avery.taylor@email.com', '0417 890 123', 'Nursing, Health education, Patient care', 'Healthcare, Wellness', 'I am a registered nurse interested in volunteering for health fairs and wellness programs.', 'volunteer_profiles/avery_taylor_signup.jpg', 'avery_documents.pdf', 'pending', NOW(), NOW()),
('550e8400-e29b-41d4-a716-446655440119', 'Blake', 'Anderson', 'blake.anderson@email.com', '0418 901 234', 'Construction, Handyman work, Safety training', 'Infrastructure, Community development', 'I am a construction worker with safety training interested in volunteering for community improvement projects.', 'volunteer_profiles/blake_anderson_signup.jpg', 'blake_documents.pdf', 'pending', NOW(), NOW());

-- Set primary keys
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `volunteer_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `volunteer_id` (`volunteer_id`);

ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `volunteer_signups`
  ADD PRIMARY KEY (`id`);

-- Add foreign key constraints
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON DELETE CASCADE;

ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`) ON DELETE SET NULL;

ALTER TABLE `volunteer_events`
  ADD CONSTRAINT `volunteer_events_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `volunteer_events_ibfk_2` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteers` (`id`) ON DELETE CASCADE;

COMMIT;
