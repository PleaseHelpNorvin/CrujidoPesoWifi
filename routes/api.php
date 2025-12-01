<?php
    $router->post('/api/add_time', 'ApiController@addTime');
    $router->post('/api/block', 'ApiController@blockUser');
    $router->post('/api/unblock', 'ApiController@unblockUser');
    $router->post('/api/vouchers', 'ApiController@redeemVoucher');