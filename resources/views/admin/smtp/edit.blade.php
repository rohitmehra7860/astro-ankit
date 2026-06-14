@extends('layouts.app')
@section('title', 'SMTP')
@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">SMTP</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0 float-start">{{ __('Edit SMTP') }}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.smtp.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mailer" class="form-label">Mailer <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="mailer"
                                            class="form-control @error('mailer') is-invalid @enderror" id="mailer"
                                            placeholder="smtp" value="{{ old('mailer', $smtp->mailer ?? '') }}">
                                        @error('mailer')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="host" class="form-label">Host <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="host"
                                            class="form-control @error('host') is-invalid @enderror" id="host"
                                            placeholder="smtp.example.com" value="{{ old('host', $smtp->host ?? '') }}">
                                        @error('host')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="port" class="form-label">Port <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="port"
                                            class="form-control @error('port') is-invalid @enderror" id="port"
                                            placeholder="587" value="{{ old('port', $smtp->port ?? '') }}">
                                        @error('port')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">Username <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror" id="username"
                                            placeholder="your@example.com"
                                            value="{{ old('username', $smtp->username ?? '') }}">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Password" value="{{ old('password', $smtp->password ?? '') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="encryption" class="form-label">Encryption</label>
                                        <select name="encryption" id="encryption"
                                            class="form-control @error('encryption') is-invalid @enderror">
                                            <option value=""
                                                {{ old('encryption', $smtp->encryption ?? '') == '' ? 'selected' : '' }}>
                                                None</option>
                                            <option value="ssl"
                                                {{ old('encryption', $smtp->encryption ?? '') == 'ssl' ? 'selected' : '' }}>
                                                SSL</option>
                                            <option value="tls"
                                                {{ old('encryption', $smtp->encryption ?? '') == 'tls' ? 'selected' : '' }}>
                                                TLS</option>
                                        </select>
                                        @error('encryption')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="from_address" class="form-label">From Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="from_address"
                                            class="form-control @error('from_address') is-invalid @enderror"
                                            id="from_address" placeholder="no-reply@example.com"
                                            value="{{ old('from_address', $smtp->from_address ?? '') }}">
                                        @error('from_address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="from_name" class="form-label">From Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="from_name"
                                            class="form-control @error('from_name') is-invalid @enderror" id="from_name"
                                            placeholder="App Name"
                                            value="{{ old('from_name', $smtp->from_name ?? '') }}">
                                        @error('from_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="mail_to" class="form-label">Mail To<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="mail_to"
                                            class="form-control @error('mail_to') is-invalid @enderror" id="mail_to"
                                            placeholder="App Name" value="{{ old('mail_to', $smtp->mail_to ?? '') }}">
                                        @error('mail_to')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
