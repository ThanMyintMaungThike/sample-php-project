<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Note Takers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/sample-php-project/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/sample-php-project/about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sample-php-project/notes/notes.php/">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sample-php-project/todos/todos.php">My Todos</a>
                </li>
            </ul>
        </div>
        <?php if (isLoggedIn()) : ?>
            <span class="navbar-text me-2">
                <?= $_SESSION['user']['email'] ?>
            </span>
            <span class="navbar-text me-2">
                <a href="/sample-php-project/auth/logout.php">Logout</a>
            </span>
        <?php else : ?>
            <span class="navbar-text me-2">
                <a href="/sample-php-project/register.php">Register</a>
            </span>
            <span class="navbar-text me-2">
                |
            </span>
            <span class="navbar-text me-2">
                <a href="/sample-php-project/auth/login.php">Login</a>
            </span>
        <?php endif; ?>
    </div>
</nav>
<div class="container">