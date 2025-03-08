@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center vh-100">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm w-100 mt-7">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Departments</h1>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <a href="executive.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Executive & Leadership</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="hr.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Human Resources</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="finance.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Finance & Accounting</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="marketing.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Marketing & Communications</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="sales.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Sales & Business Development</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="tech.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Technology & IT</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="product.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Product Development & Research</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="support.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Customer Support & Service</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="legal.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Legal & Compliance</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="operations.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Operations & Supply Chain</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="csr.html" class="text-decoration-none text-dark">
                                    <div class="card department-card">
                                        <div class="card-body">Corporate Social Responsibility</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
