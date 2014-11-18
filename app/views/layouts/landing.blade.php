@extends((( Auth::user()->type==="admin") ? 'layouts.admin' : 'layouts.user' ))

