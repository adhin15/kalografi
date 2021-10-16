<meta chart="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/911ba89c0b.js" crossorigin="anonymous"></script>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        display: flex;
        flex-direction: column;
    }



    .image-skeleton-loader:empty {
        width: 100%;
        height: 15vw;
        display: block;
        background: linear-gradient(to right,
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0.5) 50%,
                rgba(255, 255, 255, 0) 80%),
            lightgray;
        background-repeat: repeat-y;
        background-size: 50px 500px;
        background-position: 0 0;
        animation: shine 1s infinite;
        border-radius: 15px;
    }

    @keyframes shine {
        to {
            background-position: 100% 0;
        }
    }

    .order-image-skeleton-loader {

        width: 719px;
        height: 632px;
        object-fit: cover;


        display: block;
        background: linear-gradient(to right,
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0.5) 50%,
                rgba(255, 255, 255, 0) 80%),
            lightgray;
        background-repeat: repeat-y;
        background-size: 50px 500px;
        background-position: 0 0;
        animation: shine 1s infinite;
        border-radius: 15px;
    }

    .ui-datepicker-current {
        display: none;
    }

    .fs-7 {
        font-size: 12px;
    }

    .fs-9 {
        font-size: 14px;
    }

    footer {
        margin-top: auto;
        bottom: 0;
        position: absolute;
        width: 100%;
    }

    .font-primary {
        font-size: 50px;
    }

    .footer-link {
        text-decoration: none;
        color: white;
    }

    a.footer-link:hover {
        font-size: 14px;
        color: white;
    }

    .fa-stack {
        font-size: 12px;
    }

    i {
        vertical-align: middle;
    }


    .btn-kalografi-primary {
        line-height: 35px;
        width: 442.19px;
    }

    .btn-tags {
        font-size: 11px;
        color: #8F9C69;
        border-color: #8F9C69;
        border-radius: 5px;
        display: block;
        width: 100%;
    }

    .btn-tags:hover {
        color: white;
        background-color: #8F9C69;
    }

    .atribute-perks {
        font-size: 11px;
        color: #8F9C69;
        border: 1px solid;
        border-color: #8F9C69;
        border-radius: 5px;
        display: block;
        padding: 4px;
        width: 100%;
    }

    .text-kalografi {
        color: #8F9C69;
    }

    .text-custom-green {
        color: #D2C231;
    }

    .text-cyan {
        color: #7FBBC8;
    }

    .text-navy {
        color: #69779C;
    }

    .btn-kalografi {
        color: #FFFFFF;
        background-color: #8F9C69;
        opacity: 100%;
    }

    .btn-kalografi:hover {
        color: #FFFFFF;
        background-color: #8F9C69;
        opacity: 80%;
    }

    .btn-outline-kalografi {
        color: #8F9C69;
        border-color: #8F9C69;
    }

    .btn-outline-kalografi:hover {
        color: #FFFFFF;
        background-color: #8F9C69;
    }

    .btn-check-kalografi {
        color: #C4C4C4;
        border: 2px solid;
        border-color: #DCDCDC;
        border-radius: 7px;
        font-weight: 600;
    }

    .btn-check-kalografi:hover {
        color: #FFFFFF;
        border: 2px solid;
        background-color: #8F9C69;
        border-radius: 7px;
    }

    .btn-check:active+.btn-check-kalografi,
    .btn-check:checked+.btn-check-kalografi,
    .btn-check-kalografi:active,
    .btn-check-kalografi.dropdown-toggle.show,
    .btn-check-kalografi:active {
        color: #FFFFFF;
        background-color: #8F9C69;
    }

    .btn:disabled {
        color: #8F9C69;
        background-color: #FFFFFF;
        opacity: 100%;
    }

    .text-light {
        font-weight: 300;
    }

    .text-regular {
        font-weight: 400;
    }

    .semi-bold {
        font-weight: 600;
    }

    .text-bold {
        font-weight: 700;
    }

    .wrapper {
        width: 330px;
        font-family: "Helvetica";
        font-size: 14px;
        border: 1px solid #ccc;
    }

    .StepProgress {
        position: relative;
        padding-left: 45px;
        list-style: none;
    }

    .StepProgress::before {
        display: inline-block;
        content: "";
        position: absolute;
        top: 0;
        left: 15px;
        width: 10px;
        height: 100%;
        border-left: 2px solid #ccc;
    }

    .StepProgress-item {
        position: relative;
        counter-increment: list;
    }

    .StepProgress-item:not(:last-child) {
        padding-bottom: 20px;
    }

    .StepProgress-item::before {
        display: inline-block;
        content: "";
        position: absolute;
        left: -30px;
        height: 100%;
        width: 10px;
    }

    .StepProgress-item::after {
        content: "";
        display: inline-block;
        position: absolute;
        top: 0;
        left: -37px;
        width: 12px;
        height: 12px;
        border: 8px solid #ccc;
        border-radius: 50%;
        background-color: #fff;
    }

    .StepProgress-item.is-done::before {
        border-left: 2px dotted #8F9C69;
    }

    .StepProgress-item.is-done::after {

        font-size: 10px;
        color: #fff;
        text-align: center;
        border: 8px solid #8F9C69;
        background-color: #8F9C69;
    }

    .StepProgress-item.current::before {
        border-left: 2px solid #8F9C69;
    }

    .StepProgress-item.current::after {

        padding-top: 1px;
        width: 19px;
        height: 18px;
        top: -4px;
        left: -38px;
        font-size: 14px;
        text-align: center;
        color: #8F9C69;
        border: 2px solid #8F9C69;
        background-color: white;
    }

    .StepProgress strong {
        display: block;
    }


    .box-tag {
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        background-color: transparent;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        border-radius: .25rem;

    }

    .tags {
        font-weight: 700;
        font-size: 10px;
        color: #8F9C69;
        border-color: #8F9C69;
        border-radius: 5px;
        display: block;
        width: 100%;
    }

    .container-checkbox {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 8px;
        cursor: pointer;
        font-size: 12px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 17px;
        width: 17px;
        background-color: #eee;
        border-radius: 2px;
    }

    /* On mouse-over, add a grey background color */
    .container-checkbox:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container-checkbox input:checked~.checkmark {
        background-color: #8F9C69;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container-checkbox input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container-checkbox .checkmark:after {
        left: 5px;
        top: 4px;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

</style>
