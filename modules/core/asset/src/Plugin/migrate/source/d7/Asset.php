<?php

namespace Drupal\asset\Plugin\migrate\source\d7;

use Drupal\migrate_drupal\Plugin\migrate\source\d7\FieldableEntity;

/**
 * Asset source from database.
 *
 * @MigrateSource(
 *   id = "d7_asset",
 *   source_module = "farm_asset"
 * )
 */
class Asset extends FieldableEntity {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('farm_asset', 'fa')
      ->fields('fa')
      ->distinct()
      ->orderBy('id');

    if (isset($this->configuration['bundle'])) {
      $query->condition('fa.type', (array) $this->configuration['bundle'], 'IN');
    }

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('The asset ID'),
      'name' => $this->t('The asset name'),
      'type' => $this->t('The asset type'),
      'uid' => $this->t('The asset author ID'),
      'created' => $this->t('Timestamp when the asset was created'),
      'changed' => $this->t('Timestamp when the asset was last modified'),
      'archived' => $this->t('Timestamp when the asset was archived'),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['id']['type'] = 'integer';
    return $ids;
  }

}
