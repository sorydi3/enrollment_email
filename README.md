# Enrollment Email Plugin for Moodle

## Motivation
This plugin was developed to address limitations in Moodle's default enrollment notification system. The standard implementation doesn't reliably deliver enrollment notifications in all scenarios, leading to students being unaware of their course enrollments.

## Purpose
The Enrollment Email plugin ensures that users receive a notification email whenever they are enrolled in a course. Unlike the default system, this plugin:

- Sends emails asynchronously using Moodle's task scheduler
- Guarantees delivery even during bulk enrollment operations
- Provides customizable email templates

## Features
- Reliable email delivery upon course enrollment
- Customizable HTML email templates
- Support for both manual and automated enrollments
- Detailed logging for troubleshooting

## Installation
1. Download the plugin files
2. Extract to your Moodle directory at `/local/enrollment_email/`
3. Visit Site Administration to complete the installation
4. Configure email templates in the plugin settings

## Configuration
After installation, you can customize the email templates from:
Site Administration > Plugins > Local plugins > Enrollment Email

## Requirements
- Moodle 4.0 or higher
- Properly configured email settings in Moodle

## Support
For issues or feature requests, please submit them through the GitHub repository or contact the plugin maintainer.
