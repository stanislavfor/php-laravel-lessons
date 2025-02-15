@extends('layouts.default') @section('content')
<div>
    <h2>Contact Us</h2>
    <p><span>Address: </span>{{ $address }}</p>
    <p><span>Post Code: </span>{{ $post_code }}</p>
    <p><span>Phone: </span>{{ $phone }}</p>
    <p> <span>Email: </span> @if(!empty($email)) {{ $email }} @else Адрес электронной почты не указан. @endif </p>
    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam aliquid architecto cum delectus doloribus eius eveniet iste modi molestiae nesciunt porro quis recusandae, rem, sed, velit voluptas? Sequi, sunt! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam aliquid architecto cum delectus doloribus eius eveniet iste modi molestiae nesciunt porro quis recusandae, rem, sed, velit voluptas? Sequi, sunt! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam. Lorem ipsum dolor sit amet. </p>
</div> @stop
