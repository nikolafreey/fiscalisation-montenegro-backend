<?php

function getAccessToken($request) {
    return hash('sha256', explode('|', $request->bearerToken())[1]);
}
