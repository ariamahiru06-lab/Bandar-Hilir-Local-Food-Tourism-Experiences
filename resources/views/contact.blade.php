
@extends('layout.app')

@section('content')

<div class="contact-container">

    <h1>Contact Us</h1>

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif
    
    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <p class="contact-intro">
        Have questions or need more information?
        Feel free to contact us. We are happy to help!
    </p>

    <div class="contact-content">

        <div class="contact-info">
            <h2>Get In Touch</h2>

            <p>
                <strong>Location:</strong><br>
                Bandar Hilir, Melaka, Malaysia
            </p>

            <p>
                <strong>Website:</strong><br>
                Bandar Hilir Local Food & Tourism Experiences
            </p>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <label>Name</label>
                <input type="text" name="name"
                    placeholder="Enter your name" required>

                <label>Email</label>
                <input type="email" name="email"
                    placeholder="Enter your email" required>

                <label>Subject</label>
                <input type="text" name="subject"
                    placeholder="Enter subject" required>

                <label>Message</label>
                <textarea name="message" rows="5"
                    placeholder="Write your message..." required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>

    </div>
</div>

@endsection
