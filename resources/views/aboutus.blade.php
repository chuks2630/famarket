@extends('layout.famarket')

@section('content')
    
<div class="row my-4 justify-content-center">
    <div class="col-md-10">
        <h3 class="text-center">About Us</h3>
        <p style="font-size: large"><b>Welcome to Famarket Marketplace</b></p>

        <p>At Famarket Marketplace, we are revolutionizing the way agriculture meets technology. Our platform bridges the gap between farmers, buyers, and other key players in the agricultural value chain, creating a seamless and efficient marketplace where everyone thrives.
        </p>

        <h4>Our Mission</h4>
        <p>To empower the agricultural community by providing a user-friendly platform that simplifies the buying, selling, and distribution of agricultural products, services, and resources.
        </p>

        <h4>What We Do</h4>
        <ul>

            <li><b>For Farmers:</b>
            <p>We help farmers reach a wider audience, ensuring fair pricing and minimizing the challenges of middlemen. With Famarket, farmers can showcase their produce, negotiate deals, and connect directly with buyers.</p>
            </li>

            <li>
            <b>For Buyers:</b>
            <p>We provide access to high-quality, locally sourced agricultural products, all in one place. From fresh produce to farm machinery, our marketplace is a one-stop shop for all your agricultural needs.</p>
            </li>

            <li>
            <b>For Service Providers:</b>
            <p>Famarket also connects agribusinesses with service providers, such as logistics companies, equipment suppliers, and agricultural consultants, ensuring a complete ecosystem for growth.</p>
            </li>
        </ul>

        <h4>Why Choose Famarket?</h4>
        <ul>
            <li><b>Wide Reach:</b>
            <p>Our platform connects users from every corner of the country, fostering a diverse and competitive marketplace.</p>
            </li>

            <li><b>Fair Trade:</b>
            <p>We believe in empowering farmers and ensuring buyers receive the best quality products at competitive prices.</p>
            </li>
            <li>
            <b>Convenience:</b>
            <p>With an intuitive interface and robust search filters, finding what you need has never been easier.</p>
            </li>

            <li><b>Innovation:</b>
            <p>Leveraging technology, we provide features like real-time inventory updates, logistics integration, and secure payment gateways.</p>
            </li>
        </ul>

        <h4>Our Vision</h4>
        <p>To be the leading online platform driving agricultural innovation and fostering sustainable growth for all stakeholders in the agricultural value chain.</p>

        <h4>Join Us</h4>
        <p>Whether you're a farmer, buyer, or service provider, Famarket Marketplace is your gateway to growth and success in agriculture. Together, we can transform the agricultural industry and contribute to a sustainable future.</p>

        <p>Start your journey with us today.  <a href="{{route('register')}}">Sign Up Now</a></p>
    </div>
</div>
@endsection