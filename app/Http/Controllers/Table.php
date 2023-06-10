<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Table extends Controller
{
    const MAIN_CATEGORY = 'main_category';
    const SUB_CATEGORY = 'sub_category';
    const HOME_CATEGORIES = 'home_categories';
    const HOME_CATEGORIES_VISIBILITY = 'home_categories_visibility';
    const MOVIES = 'movies';
    const FEATURE_MOVIES = 'feature_movies';
    const USER_FAVOURITES = 'user_favourites';

    const CURRENT_SUBSCRIPTION = 'current_subcription';
    const SUBSCRIPTION_BUY_HISTORY = 'subscription_buy_history';
}
