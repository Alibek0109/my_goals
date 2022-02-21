<div class="d-flex flex-column p-3 text-white bg-dark vh-100 h-100">
    <a href="{{route('home.index')}}" class="nav-link text-white">
        <h2>Manage</h2>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column">
        <div class="theme-group">
            <li class="nav-item">
                <a href="{{ route('home.daily.index') }}" class="nav-link text-white">
                    <h3 class="mb-0">Daily Plan</h3>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home.daily.create') }}" class="nav-link text-white">
                    Create daily plan
                </a>
            </li>
            <hr>
        </div>

        <div class="theme-group">
            <li>
                <a href="#" class="nav-link text-white">
                    <h3 class="mb-0">English words</h3>
                </a>
            </li>
            <hr>
        </div>
        <div class="theme-group">
            <li>
                <a href="#" class="nav-link text-white">
                    <h3 class="mb-0">Workout</h3>
                </a>
            </li>
            <hr>
        </div>
        <div class="theme-group">
            <li>
                <a href="#" class="nav-link text-white">
                    <h3 class="mb-0">Plans</h3>
                </a>
            </li>
            <hr>
        </div>
    </ul>
</div>
