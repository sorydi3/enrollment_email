<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local plugin "enrollment_email" - Language strings
 *
 * @package    local_enrollment_email
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 $string['pluginname'] = 'Notificació de matrícula per correu electrònic';
 $string['email_subject'] = 'Has estat matriculat al curs: {$a}';
 $string['email_body'] = 'Hola {$a->firstname},  
 
 Has estat matriculat al curs "{$a->coursename}".  
 
 Pots accedir al curs a: <a href="{$a->courseurl}">Curs</a>.
 
 Gràcies!';
 
 $string['email_body_html'] = '
 <!DOCTYPE html>
 <html>
 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <style>
         body {
             font-family: Arial, sans-serif;
             line-height: 1.6;
             color: #333;
             max-width: 600px;
             margin: 0 auto;
             padding: 20px;
         }
         .header {
             background-color: #00545F;
             color: white;
             padding: 15px;
             border-radius: 5px 5px 0 0;
             text-align: center;
         }
         .content {
             padding: 20px;
             border: 1px solid #ddd;
             border-top: none;
             border-radius: 0 0 5px 5px;
         }
         .button {
             display: inline-block;
             background-color: #4CAF50;
             color: white;
             padding: 10px 20px;
             text-decoration: none;
             border-radius: 4px;
             margin-top: 15px;
         }
         .footer {
             margin-top: 20px;
             font-size: 12px;
             color: #777;
             text-align: center;
         }
     </style>
 </head>
 <body>
     <div class="header">
         <h2>Notificació de matrícula al curs</h2>
     </div>
     <div class="content">
         <p>Hola <strong>{$a->firstname}</strong>,</p>
         
         <p>Et confirmem que has estat matriculat amb èxit al curs:</p>
         
         <h3>{$a->coursename}</h3>
         
         <p>Pots accedir als materials del curs i començar el teu aprenentatge immediatament.</p>
         
         <p><a href="{$a->courseurl}" class="button">Accedir al curs</a></p>
         
         <p>Si el botó anterior no funciona, pots copiar i enganxar aquest enllaç al teu navegador:</p>
         <p>{$a->courseurltext}</p>
         
         <p>Et desitgem una experiència d’aprenentatge exitosa!</p>
     </div>
     <div class="footer">
         <p>Aquest és un missatge automàtic. Si us plau, no responguis aquest correu.</p>
     </div>
 </body>
 </html>
 ';