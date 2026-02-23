#!/bin/bash
# Build script for Vercel - writes runtime secrets from env vars
echo "<?php return ['groq_key' => '${GROQ_API_KEY}'];" > config/runtime_secrets.php
echo "Build: runtime_secrets.php generated."
