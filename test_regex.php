<?php
$url='postgresql://neondb_owner:npg_Cdm8Bph6YQSK@ep-proud-voice-aob6xd5q.c-2.ap-southeast-1.aws.neon.tech/neondb?sslmode=require'; 
preg_match('/@(ep-[a-z0-9\-]+)\./', $url, $matches); 
$endpoint = $matches[1]; 
echo preg_replace('/:\/\/(.*?):/', '://' . $endpoint . '$${1}:', $url);
