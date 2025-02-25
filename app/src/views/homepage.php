
        <div class="flex flex-col w-11/12 items-center justify-start">
            <h1 class="text-4xl">Wonderful blog</h1>

            <div
                class="flex flex-col w-full items-center justify-start space-y-4"
            >
                <?php foreach($getBlogs as $blog): ?>
                <div
                    class="flex flex-col w-full items-center justify-start border border-gray-300 p-4"
                >
                    <a
                        href="/blogs/index.php?id=<?= $blog['id'] ?>"
                        class="text-2xl"
                        ><?= $blog['title'] ?></a
                    >
                    <a href="/users.php?id=<?= $blog['user_id'] ?>" class="p"
                        >By
                        <?= $blog['name'] ?></a
                    >
                </div>
                <?php endforeach; ?>
            </div>

            <div
                class="flex flex-row w-full items-center justify-center space-x-4"
            >
                <?php for ($i = 1; $i <= getPagination()['pagesCount']; $i++): ?>
                <?php if($i !== getPage()): ?>
                <a href="/?page=<?= $i ?>" class="text-xl underline text-gray"
                    ><?= $i ?></a
                >
                <?php else: ?>
                <p class="text-2xl font-bold text-black"><?= $i ?></p>
                <? endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>

