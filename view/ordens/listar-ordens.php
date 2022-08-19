<?php include __DIR__ . '/../inicio-html.php'; ?>

    <a href="/nova-ordem" class="btn btn-primary mb-2">
        Novo curso
    </a>

    <ul class="list-group">
        <?php foreach ($ordens as $ordem): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $ordem->getDescricao(); ?>

                <span>
                    <a href="/alterar-ordem?id=<?= $ordem->getId(); ?>" class="btn btn-info btn-sm">
                        Alterar
                    </a>
                    <a href="/excluir-ordem?id=<?= $ordem->getId(); ?>" class="btn btn-danger btn-sm">
                        Excluir
                    </a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>

<?php include __DIR__ . '/../fim-html.php'; ?>