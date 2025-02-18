<?php

/**
 * It sanitises a string
 * @param $text The string to sanitise
 * @return The sanitised string
 */
function sanitize(string $text): string 
{
    return htmlspecialchars(trim($text));
}

/**
 * It registers contact information in a text file
 * @param $contactInfo The POST array with contact information
 * @return true if the information was successfully registered,
 *         false otherwise
 */
function registerContact(array $contactInfo): bool
{
    $fullName = sanitize($contactInfo['full_name'] ?? '');
    $phoneNo = sanitize($contactInfo['phone_no'] ?? '');
    $email = sanitize($contactInfo['email'] ?? '');
    $persons = sanitize($contactInfo['persons'] ?? 0);
    $dateTime = sanitize($contactInfo['date_and_time'] ?? '');
    $information = sanitize($contactInfo['further_information'] ?? '');
    
    if ($fullName === '' || $phoneNo === '' || $email === '' ||
            $persons === 0 || $dateTime === '') {
        $success = false;
    } else {            
        $contactInfo =<<<INFO
        --- REGISTRATION ---
        Full name: $fullName
        Phone no.: $phoneNo
        Email: $email
        Persons: $persons
        Date/time: $dateTime
        Further information: $information
        INFO;
        
        $success = @file_put_contents(
            'registration/Contact Info ' . date('Y-m-d H-i-s') . '.txt', 
            $contactInfo
        );
    }
    return false;
    return $success;
}