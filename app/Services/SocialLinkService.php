<?php

namespace Blog\Services;

use Blog\Repositories\SocialLinkRepository;

/** 
 * Класс сервиса социальных ссылок
 */
class SocialLinkService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param SocialLinksRepository $linksRepository
    */ 
   public function __construct(SocialLinkRepository $linksRepository)
   {
       $this->repo = $linksRepository;
   }
   
    /**
    * Возвращает социальные, отсортированные по значению сортировки
    * @return Blog\Models\SocialLink
    */  
    public function getSortedLinks()
    {
        $this->repo->setSortBy('sort');
        $this->repo->setSortOrder('asc');

        return $this->repo->all();
    }
   
    /**
    * Возвращает социальные постранично
    * @return Blog\Models\SocialLink
    */  
    public function paginated($paginate)
    {
        $this->repo->setSortBy('id');
        $this->repo->setSortOrder('asc');
        
        return $this->repo->paginated($paginate);
    }
    
           
    /**
    * Находит социальную ссылку по внешней ссылки
    * @param string $href
    * @return Blog\Models\SocialLink
    */  
    public function findByHref($href)
    {
        $this->repo->setFilterBy('href');
        $this->repo->setFilterValue($href); 
        
        return $this->repo->all()->first();
    }
    
}