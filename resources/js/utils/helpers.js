function insertNodeAt(fatherNode, node, position) {
  const refNode =
    position === 0
      ? fatherNode.children[0]
      : fatherNode.children[position - 1].nextSibling;

  fatherNode.insertBefore(node, refNode);
}

export { insertNodeAt };
