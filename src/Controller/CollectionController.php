<?php


namespace App\Controller;

use App\Model\CollectionManager;

class CollectionController extends AbstractController
{
    /**
     * Display Collection PAge
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Collection/collection.html.twig');
    }

    /**
     * Display collection informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $collectionManager = new collectionManager();
        $collection = $collectionManager->selectOneById($id);

        return $this->twig->render('Collection/collection.html.twig', ['item' => $collection]);
    }


    /**
     * Display collection  edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $collectionManager = new CollectionManager();
        $collection = $collectionManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collection['title'] = $_POST['title'];
            $collectionManager->update($collection);
        }

        return $this->twig->render('Collection/collection.html.twig', ['collection' => $collection]);
    }


    /**
     * Display collection creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $collectionManager = new CollectionManager();
            $collection = [
                'title' => $_POST['title'],
            ];
            $id = $collectionManager->insert($collection);
            header('Location:/Collection/show/' . $id);
        }

        return $this->twig->render('Collection/collection.html.twig');
    }


    /**
     * Handle collection deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $collectionManager = new CollectionManager();
        $collectionManager->delete($id);
        header('Location:/Collection/collection.html.twig');
    }
}
