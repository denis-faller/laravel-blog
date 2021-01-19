<?php

namespace Blog\Services;

use Blog\Repositories\MailingRepository;

/** 
 * Класс сервиса рассылки
 */
class MailingService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param MailingRepository $subscriberRepository
    */ 
    public function __construct(MailingRepository $mailingRepository)
    {
        $this->repo = $mailingRepository;
    }
    
    /**
    * Возвращает рассылку с определенным postID
    * @param int $postID
    * @return Blog\Models\Mailing
    */  
    public function findByPostID($postID)
    {
        $this->repo->setFilterBy('post_id');
        $this->repo->setFilterValue($postID); 
        
        return $this->repo->all()->last();
    }
}