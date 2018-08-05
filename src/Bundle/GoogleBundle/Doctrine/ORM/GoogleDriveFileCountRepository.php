<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Google\Repository\GoogleRepositoryInterface;

class GoogleDriveFileCountRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function insertView($fileId)
    {
        $em = $this->getEntityManager();
        $sql = "INSERT INTO google_drive_file_count (file_id, count_view) VALUES (:fileId, :countView);";

        $params = [
            'fileId' => $fileId,
            'countView' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFileCount google
            WHERE
            google.id = :id AND
            google.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilesCount(): array
    {
        $em = $this->getEntityManager();
        $sql = "SELECT COUNT(id) AS count_, file_id FROM google_drive_file_count GROUP BY file_id LIMIT 10;";

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
